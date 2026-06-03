<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'color_hex', 'is_active', 'sort_order', 'meta_title', 'meta_description'
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'category_id');
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class, 'category_id');
    }
}
