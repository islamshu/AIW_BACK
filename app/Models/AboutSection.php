<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutSection extends Model
{
    use HasTranslations;

    protected $fillable = [
        'key',
        'title',
        'content',
        'is_active',
    ];

    public $translatable = [
        'title',
        'content',
    ];
}
