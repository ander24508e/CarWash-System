<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = ['name_product', 'name_categoria', 'stock', 'description', 'brand', 'supplier', 'precio_compra', 'precio_venta'];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'name_categoria', 'id');
        // 'name_categoria' es la FK en 'productos' que apunta a 'id' en 'categorias'
    }
}
