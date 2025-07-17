<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicios extends Model
{
    use HasFactory;
    protected $fillable = ["name_service", "kind_service", "price_premium", "price_basic", "vehiculo_id"]; 
}
