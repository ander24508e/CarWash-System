<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facturas extends Model
{
    use HasFactory;
    protected $fillable = ['customer', 'identification', 'date', 'address', 'discount', 'description', 'precio_subtotal', 'precio_total'];
}
