<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Artist extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id', 'branch_id', 'display_name', 'slug', 'bio', 'tagline',
        'experience_years', 'specializations', 'awards', 'social_links',
        'profile_photo', 'cover_photo', 'base_hourly_rate', 'min_booking_notice_hours',
        'max_advance_booking_days', 'working_days', 'work_start_time', 'work_end_time',
        'slot_duration_minutes', 'break_duration_minutes', 'commission_type',
        'commission_value', 'is_active', 'accepts_walk_ins', 'sort_order',
        'meta_title', 'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'specializations'    => 'array',
            'awards'             => 'array',
            'social_links'       => 'array',
            'working_days'       => 'array',
            'work_start_time'    => 'string',
            'work_end_time'      => 'string',
            'is_active'          => 'boolean',
            'accepts_walk_ins'   => 'boolean',
            'base_hourly_rate'   => 'decimal:2',
            'commission_value'   => 'decimal:2',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['display_name', 'is_active', 'commission_value']);
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function bookingSlots(): HasMany
    {
        return $this->hasMany(BookingSlot::class);
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(ArtistCommission::class);
    }

    // Helpers
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo) {
            if (str_starts_with($this->profile_photo, 'images/')) {
                return asset($this->profile_photo);
            }
            return asset('storage/' . $this->profile_photo);
        }
        return asset('images/dharam_sahu.jpg');
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->where('status', 'approved')->avg('overall_rating') ?? 5.0, 1);
    }

    public function getTotalBookingsAttribute(): int
    {
        return $this->bookings()->whereIn('status', ['completed'])->count();
    }

    /**
     * Check if artist is available on a given date and time.
     * Core conflict-detection logic.
     */
    public function isAvailable(\Carbon\Carbon $date, string $startTime, string $endTime): bool
    {
        // Check working days
        $dayName = strtolower($date->format('l'));
        if (!in_array($dayName, $this->working_days ?? [])) {
            return false;
        }

        // Check against work hours
        if ($startTime < $this->work_start_time || $endTime > $this->work_end_time) {
            return false;
        }

        // Check for conflicting bookings
        $conflict = $this->bookings()
            ->where('appointment_date', $date->toDateString())
            ->whereNotIn('status', ['cancelled', 'no_show'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    // New slot overlaps existing: starts before existing ends AND ends after existing starts
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
                });
            })
            ->exists();

        if ($conflict) {
            return false;
        }

        // Check for blocked slots
        $blocked = $this->bookingSlots()
            ->where('slot_date', $date->toDateString())
            ->whereIn('status', ['blocked', 'booked'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
            })
            ->exists();

        return !$blocked;
    }

    /**
     * Get available time slots for a given date.
     */
    public function getAvailableSlots(\Carbon\Carbon $date, int $durationMinutes = 60): array
    {
        $dayName = strtolower($date->format('l'));
        if (!in_array($dayName, $this->working_days ?? [])) {
            return [];
        }

        $slots        = [];
        $start        = \Carbon\Carbon::parse($date->toDateString() . ' ' . $this->work_start_time);
        $end          = \Carbon\Carbon::parse($date->toDateString() . ' ' . $this->work_end_time);
        $slotDuration = $this->slot_duration_minutes;
        $breakDuration = $this->break_duration_minutes;

        // Get all booked ranges for this day
        $bookedRanges = $this->bookings()
            ->where('appointment_date', $date->toDateString())
            ->whereNotIn('status', ['cancelled', 'no_show'])
            ->get(['start_time', 'end_time'])
            ->toArray();

        $blockedRanges = $this->bookingSlots()
            ->where('slot_date', $date->toDateString())
            ->whereIn('status', ['blocked', 'booked', 'break'])
            ->get(['start_time', 'end_time'])
            ->toArray();

        $allOccupied = array_merge($bookedRanges, $blockedRanges);

        $current = $start->copy();
        $noticeDeadline = now()->addHours($this->min_booking_notice_hours);

        while ($current->copy()->addMinutes($durationMinutes)->lte($end)) {
            $slotStart = $current->format('H:i:s');
            $slotEnd   = $current->copy()->addMinutes($durationMinutes)->format('H:i:s');
            $slotDateTime = \Carbon\Carbon::parse($date->toDateString() . ' ' . $slotStart);

            // Skip past slots & slots inside notice window
            if ($slotDateTime->lt($noticeDeadline)) {
                $current->addMinutes($slotDuration + $breakDuration);
                continue;
            }

            $hasConflict = false;
            foreach ($allOccupied as $occupied) {
                $occStart = $occupied['start_time'];
                $occEnd   = $occupied['end_time'];
                if ($slotStart < $occEnd && $slotEnd > $occStart) {
                    $hasConflict = true;
                    break;
                }
            }

            if (!$hasConflict) {
                $slots[] = [
                    'start'       => $slotStart,
                    'end'         => $slotEnd,
                    'label'       => $current->format('h:i A') . ' – ' . $current->copy()->addMinutes($durationMinutes)->format('h:i A'),
                    'available'   => true,
                ];
            }

            $current->addMinutes($slotDuration + $breakDuration);
        }

        return $slots;
    }
}
