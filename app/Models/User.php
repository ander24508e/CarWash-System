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
        return "{$this->name} {$this->apellido}";
    }

    // Accesor para URL de foto
    public function getFotoPerfilUrlAttribute()
    {
        return $this->foto_perfil 
            ? asset('storage/' . $this->foto_perfil)
            : asset('images/default-avatar.png');
    }

    // Métodos helpers personalizados (opcional)
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isUser(): bool
    {
        return $this->hasRole('user');
    }

    public function isClient(): bool
    {
        return $this->hasRole('client');
    }
}