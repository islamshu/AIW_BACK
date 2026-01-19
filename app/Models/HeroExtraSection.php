<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroExtraSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'background',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'button_text' => 'array',
        'button_link' => 'array',
    ];

    public function homeSection()
    {
        return $this->morphOne(HomeSection::class, 'contentable');
    }
}
