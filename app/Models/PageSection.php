<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'type',
        'data',
        'order',
        'is_active',
        'layout_id',
        'column_index',
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
        'content' => 'array',
        'column_index' => 'integer',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    // (لو عندك content مستخدم لبعض الأقسام)
    protected function content(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $content = is_array($value) ? $value : [];

                $content['items'] = collect($content['items'] ?? [])
                    ->map(fn ($item) => (array) $item)
                    ->toArray();

                return $content;
            }
        );
    }
}
