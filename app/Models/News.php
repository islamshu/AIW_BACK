<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'image',
        'is_active',
        'published_at',
    ];

    public $translatable = [
        'title',
        'excerpt',
        'content',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
