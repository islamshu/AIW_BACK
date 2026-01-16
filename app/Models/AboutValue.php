<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutValue extends Model
{
    use HasTranslations;

    protected $fillable = [
        'icon',
        'title',
        'sort_order',
        'is_active',
    ];

    public $translatable = [
        'title',
    ];
}
