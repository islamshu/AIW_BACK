<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'key',
        'order',
        'is_active',
        'contentable_id',
        'contentable_type',
    ];

    public function contentable()
    {
        return $this->morphTo();
    }
}
