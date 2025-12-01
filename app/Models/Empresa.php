<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Empresa extends Model
{
    protected $fillable = [
        'user_id', // ← AGREGAR ESTO
        'nombre',
        'direccion',
        'telefono',
        'logo'
    ];

    /**
     * Relación CORREGIDA: Una empresa pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class); // ← CAMBIAR A belongsTo
    }

    /**
     * Accessor para la URL del logo
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            return Storage::url($this->logo);
        }

        return asset('images/logo-empresa-default.png');
    }
}