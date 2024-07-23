<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
class Serves extends Model  implements HasMedia {
    use HasFactory, InteractsWithMedia, HasTranslations;

        public $translatable = [ 'title'];
        protected $fillable = [ 'type'];
        public function serves_items()
        {
            return $this->hasMany(ServesItem::class);
        }

}
