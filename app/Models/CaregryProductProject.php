<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class CaregryProductProject extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia, HasTranslations;
    protected $fillable = [
        'title',
        'description',
        'link',
        'category_id',
        'location',
        'scope'
    ];
    public $translatable = [ 'title', 'description','scope','location' ];

    public function category() {
        return $this->belongsTo(CaregryProduct::class, 'category_id', 'id');
    }


}
