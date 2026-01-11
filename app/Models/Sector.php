<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Sector extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'badge_text',
        'icon',
        'image',
        'gradient_from',
        'gradient_to',
        'market_value',
        'market_percent',
        'order',
        'is_active',
    ];

    public $translatable = [
        'title',
        'description',
        'badge_text',
    ];
}
