<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $table = 'hero_sections';

    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'image',
    ];

    protected $casts = [
        'title'        => 'array',
        'subtitle'     => 'array',
        'button_text'  => 'array',
        'button_link'  => 'array',
    ];

    /**
     * علاقة السكشن بالصفحة الرئيسية
     */
    public function homeSection()
    {
        return $this->morphOne(HomeSection::class, 'contentable');
    }
}
