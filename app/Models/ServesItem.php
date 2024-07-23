<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class ServesItem extends Model  implements HasMedia {
    use HasFactory, InteractsWithMedia, HasTranslations;
    public $translatable = ['itim'];
    protected $fillable = ['serves_id', 'itim_en', 'itim_ar'];
    public function serves()
    {
        return $this->belongsTo(Serves::class);
    }

}
