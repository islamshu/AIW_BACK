<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class HomeService extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',    
        'order',
        'is_active',
    ];
    

    public $translatable = [
        'title',
        'description',
    ];
   
    
}
