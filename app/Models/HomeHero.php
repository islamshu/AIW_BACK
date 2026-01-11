<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomeHero extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'image',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'button_text',
    ];
}
