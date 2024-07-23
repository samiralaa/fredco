<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perant extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use HasFactory;
    public $translatable = ['title'];
    protected $fillable = ['title'];

   public function categorys()
{
    return $this->hasMany(Category::class, 'parent_id');
}

    public function registerMediaCollections(): void
{
    // Collection for original images
    $this->addMediaCollection('original-images')->singleFile();

    // Collection for fallback images
    $this->addMediaCollection('fallback-images')->singleFile()->useFallbackUrl('https://via.placeholder.com/350x150.png');
}

}
