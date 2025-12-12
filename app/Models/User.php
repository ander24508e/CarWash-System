<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'apellido',
        'email',
        'password',
        'telefono',
        'foto_perfil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Accesor para nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->name} {$this->apellido}");
    }

    // Accesor para URL de foto
    public function getFotoPerfilUrlAttribute()
    {
        return $this->foto_perfil 
            ? asset('storage/' . $this->foto_perfil)
            : asset('images/default-avatar.png');
    }

    // Métodos helpers personalizados
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isEmpleado(): bool
    {
        return $this->hasRole('user') || $this->hasRole('empleado') || $this->hasRole('admin');
    }

    public function isClient(): bool
    {
        return $this->hasRole('client');
    }

    // =============================================
    // RELACIONES SIMPLIFICADAS
    // =============================================

    /**
     * Ventas donde este usuario es el CLIENTE (sus compras)
     */
    public function compras()
    {
        return $this->hasMany(Venta::class, 'cliente_id', 'id');
    }

    /**
     * Venta donde este usuario es el EMPLEADO (las que realizó)
     */
    public function ventasRealizadas()
    {
        return $this->hasMany(Venta::class, 'empleado_id', 'id');
    }

    /**
     * Vehículos del cliente
     */
    public function vehiculos()
    {
        return $this->hasMany(vehiculos::class, 'user_id', 'id');
    }
}