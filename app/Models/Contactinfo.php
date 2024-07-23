<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Contactinfo extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['address'];
    protected $fillable = [
        'email',
        'phone',
        'type_site',
    ];


}
