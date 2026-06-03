<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity;

    protected $fillable = [
        'name', 'email', 'password', 'branch_id', 'phone', 'whatsapp',
        'avatar', 'date_of_birth', 'gender', 'address', 'city', 'state',
        'pincode', 'referral_code', 'referred_by', 'loyalty_points',
        'is_active', 'age_verified', 'last_visited_at', 'preferences',
        'google_id', 'facebook_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_visited_at'   => 'datetime',
            'date_of_birth'     => 'date',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
            'age_verified'      => 'boolean',
            'preferences'       => 'array',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['name', 'email', 'is_active']);
    }

    // Relationships
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function artist(): HasOne
    {
        return $this->hasOne(Artist::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function loyaltyTransactions(): HasMany
    {
        return $this->hasMany(LoyaltyTransaction::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function membership(): HasOne
    {
        return $this->hasOne(Membership::class)->where('status', 'active')->latest();
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    // Helpers
    public function isArtist(): bool
    {
        return $this->hasRole(['artist']);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(['super-admin', 'admin', 'manager']);
    }

    public function isCustomer(): bool
    {
        return $this->hasRole('customer');
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=D4AF37&color=050505&bold=true';
    }

    public function addLoyaltyPoints(int $points, string $type, string $description, ?int $bookingId = null): void
    {
        $newBalance = $this->loyalty_points + $points;
        $this->increment('loyalty_points', $points);

        LoyaltyTransaction::create([
            'user_id'      => $this->id,
            'booking_id'   => $bookingId,
            'type'         => $type,
            'points'       => $points,
            'balance_after' => $newBalance,
            'description'  => $description,
        ]);
    }
}
