<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'artist_id', 'category_id', 'booking_id', 'title', 'slug', 'description',
        'media_type', 'file_path', 'thumbnail_path', 'before_image_path', 'after_image_path',
        'watermarked_path', 'has_watermark', 'tags', 'tattoo_style', 'body_placement',
        'is_featured', 'is_published', 'likes_count', 'views_count', 'sort_order',
        'alt_text', 'meta_title', 'meta_description'
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'has_watermark' => 'boolean',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail_path) {
            if (str_starts_with($this->thumbnail_path, 'http://') || str_starts_with($this->thumbnail_path, 'https://')) {
                return $this->thumbnail_path;
            }
            return asset('storage/' . $this->thumbnail_path);
        }
        return 'https://images.unsplash.com/photo-1549490349-8643362247b5?w=500&auto=format&fit=crop';
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->file_path) {
            if (str_starts_with($this->file_path, 'http://') || str_starts_with($this->file_path, 'https://')) {
                return $this->file_path;
            }
            return asset('storage/' . $this->file_path);
        }
        return $this->thumbnail_url;
    }
}
