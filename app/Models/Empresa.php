<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Empresa extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'logo'
    ];

    /**
     * Accessor para la URL del logo
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            return Storage::url($this->logo);
        }

        return asset('Images/lavadora-logo.jpg');
    }
}