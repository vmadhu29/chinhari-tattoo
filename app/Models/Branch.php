<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'address', 'city', 'state', 'pincode', 'phone',
        'whatsapp', 'email', 'google_maps_url', 'google_place_id',
        'latitude', 'longitude', 'working_hours', 'is_active',
        'is_main_branch', 'meta_title', 'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'working_hours'  => 'array',
            'is_active'      => 'boolean',
            'is_main_branch' => 'boolean',
            'latitude'       => 'float',
            'longitude'      => 'float',
        ];
    }

    public function artists(): HasMany
    {
        return $this->hasMany(Artist::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function bookingSlots(): HasMany
    {
        return $this->hasMany(BookingSlot::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function getFormattedHoursAttribute(): string
    {
        return 'Mon – Sun: 10:00 AM – 9:00 PM'; // Will be dynamic later
    }
}
