<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehiculos extends Model
{
    use HasFactory;
    protected $fillable = ['placa', 'customer', 'brand_vehicle', 'model_vehicle', 'color'];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'customer', 'id');
    }
}
