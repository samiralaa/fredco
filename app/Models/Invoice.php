<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name', 'client_location', 'client_address','total','due_date'
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}