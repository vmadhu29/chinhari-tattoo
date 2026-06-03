<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'author_id', 'title', 'slug', 'excerpt', 'content',
        'featured_image', 'tags', 'status', 'published_at', 'reading_time_minutes',
        'views_count', 'meta_title', 'meta_description', 'og_image', 'schema_markup'
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'tags' => 'array',
            'schema_markup' => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
