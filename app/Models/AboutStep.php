<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutStep extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    public $translatable = [
        'title',
        'description',
    ];
}
