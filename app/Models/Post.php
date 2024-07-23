<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Post extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia, HasTranslations;
 
    protected $fillable = [
        'title',
        'description',
        'location',
        'link',
        'scope',
    ];
      public $translatable = [ 'title', 'description','scope','location' ];
}
