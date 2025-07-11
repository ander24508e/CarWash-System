<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = ['name_product', 'name_categoria', 'stock', 'description', 'brand', 'supplier', 'precio_compra', 'precio_venta'];
}
