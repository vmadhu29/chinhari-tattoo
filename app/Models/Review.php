<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'author_name',
        'author_initials',
        'avatar_color',
        'rating',
        'relative_time',
        'content',
    ];
}
