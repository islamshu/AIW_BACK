<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomeService extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',     // ✅ جديد
        'order',
        'is_active',
    ];
    

    public $translatable = [
        'title',
        'description',
    ];
}
