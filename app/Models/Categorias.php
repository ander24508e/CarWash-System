<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $fillable = ['name_category'];

    public function productos()
    {
        return $this->hasMany(Productos::class, 'name_category', 'id');
    }
}
