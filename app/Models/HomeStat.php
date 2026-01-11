<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomeStat extends Model
{
    use HasTranslations;

    protected $fillable = [
        'label',
        'value',
        'order',
    ];

    public $translatable = [
        'label',
    ];
}
