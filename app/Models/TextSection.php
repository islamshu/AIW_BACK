<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextSection extends Model
{
    protected $fillable = [
        'content',
        'button_text',
        'button_link',
    ];

    protected $casts = [
        'content' => 'array',
        'button_text' => 'array',
        'button_link' => 'array',
    ];

    public function homeSection()
    {
        return $this->morphOne(HomeSection::class, 'contentable');
    }
}

