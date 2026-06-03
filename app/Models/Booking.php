<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Booking extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'booking_number', 'user_id', 'artist_id', 'branch_id', 'service_id', 'booking_slot_id',
        'appointment_date', 'start_time', 'end_time', 'duration_minutes',
        'tattoo_placement', 'tattoo_size', 'color_type', 'complexity',
        'estimated_sessions', 'current_session', 'customer_requirements', 'reference_images',
        'status', 'cancellation_reason', 'confirmed_at', 'completed_at', 'cancelled_at',
        'quoted_price', 'final_price', 'deposit_amount', 'deposit_paid',
        'deposit_payment_id', 'payment_status',
        'consent_signed', 'consent_form_path', 'medical_declaration_signed',
        'age_verified', 'digital_signature_path',
        'is_walk_in', 'is_touch_up', 'parent_booking_id',
        'admin_notes', 'artist_notes',
        'voucher_code', 'voucher_discount',
        'loyalty_points_earned', 'loyalty_points_used',
        'reschedule_count', 'original_appointment_date',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date'         => 'date',
            'original_appointment_date' => 'date',
            'reference_images'         => 'array',
            'confirmed_at'             => 'datetime',
            'completed_at'             => 'datetime',
            'cancelled_at'             => 'datetime',
            'deposit_paid'             => 'boolean',
            'consent_signed'           => 'boolean',
            'medical_declaration_signed' => 'boolean',
            'age_verified'             => 'boolean',
            'is_walk_in'               => 'boolean',
            'is_touch_up'              => 'boolean',
            'quoted_price'             => 'decimal:2',
            'final_price'              => 'decimal:2',
            'deposit_amount'           => 'decimal:2',
            'voucher_discount'         => 'decimal:2',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['status', 'appointment_date', 'artist_id']);
    }

    protected static function booted(): void
    {
        static::creating(function (Booking $booking) {
            if (empty($booking->booking_number)) {
                $booking->booking_number = 'CHN-' . date('Y') . '-' . str_pad(
                    static::withTrashed()->count() + 1,
                    5,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(BookingSlot::class, 'booking_slot_id');
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function timeline(): HasMany
    {
        return $this->hasMany(BookingTimeline::class)->orderBy('created_at');
    }

    public function consentForms(): HasMany
    {
        return $this->hasMany(ConsentForm::class);
    }

    public function aftercareSchedules(): HasMany
    {
        return $this->hasMany(AftercareSchedule::class);
    }

    public function designApprovals(): HasMany
    {
        return $this->hasMany(DesignApproval::class)->orderByDesc('version');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function parentBooking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'parent_booking_id');
    }

    public function touchUps(): HasMany
    {
        return $this->hasMany(Booking::class, 'parent_booking_id');
    }

    // Status helpers
    public function isPending(): bool   { return $this->status === 'pending'; }
    public function isConfirmed(): bool { return $this->status === 'confirmed'; }
    public function isCompleted(): bool { return $this->status === 'completed'; }
    public function isCancelled(): bool { return $this->status === 'cancelled'; }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'     => 'bg-yellow-500/20 text-yellow-400',
            'confirmed'   => 'bg-blue-500/20 text-blue-400',
            'in_progress' => 'bg-purple-500/20 text-purple-400',
            'completed'   => 'bg-green-500/20 text-green-400',
            'cancelled'   => 'bg-red-500/20 text-red-400',
            'rescheduled' => 'bg-orange-500/20 text-orange-400',
            'no_show'     => 'bg-gray-500/20 text-gray-400',
            default       => 'bg-gray-500/20 text-gray-400',
        };
    }

    public function addTimelineEvent(string $eventType, string $title, ?string $description = null, ?array $metadata = null): void
    {
        $this->timeline()->create([
            'user_id'    => auth()->id(),
            'event_type' => $eventType,
            'title'      => $title,
            'description' => $description,
            'metadata'   => $metadata,
        ]);
    }
}
