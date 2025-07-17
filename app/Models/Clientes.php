<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $fillable = ['name_customer', 'lastname_customer', 'identification', 'email', 'phone', 'address'];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class, 'customer', 'id');
    }
}
