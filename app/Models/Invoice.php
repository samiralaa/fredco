<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name', 'client_location', 'client_address',
        'company_name', 'company_taxId', 'company_location',
        'company_address', 'created_date', 'due_date', 'total'
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}