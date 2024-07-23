<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class CaregryProduct extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia, HasTranslations;
    public $translatable = [ 'title' ];
    protected $fillable = [ 'title'];
    // ...
    // public function registerMediaCollections(): void {
    //     $this->addMediaCollection('image')->singleFile();
    // }
   public function caregryproductprojects() {
        return $this->hasMany(CaregryProductProject::class, 'category_id', 'id');
    }
    
  
    
}
