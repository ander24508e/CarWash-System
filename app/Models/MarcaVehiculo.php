<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaVehiculo extends Model
{
    use HasFactory;
    protected $fillable = ['name_brand', 'image'];


    public function ModelVehiculo()
    {
        return $this->hasMany(Productos::class, 'name_brand', 'id');
    }

    
}
