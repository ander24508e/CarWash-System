<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'telefono',
        'foto_perfil',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Obtener URL completa de la foto de perfil
     */
    public function getFotoPerfilUrlAttribute(): string
    {
        // Verificar si existe la foto y la ruta no está vacía
        if ($this->foto_perfil && !empty($this->foto_perfil)) {
            // Verificar que el archivo existe físicamente
            if (Storage::disk('public')->exists($this->foto_perfil)) {
                return Storage::url($this->foto_perfil);
            }
        }

        // Si no hay foto o no existe, retornar avatar por defecto
        return $this->getAvatarDefaultAttribute();
    }

    /**
     * Generar avatar con iniciales
     */
    public function getAvatarDefaultAttribute(): string
    {
        $iniciales = strtoupper(substr($this->name, 0, 1) . substr($this->apellido ?? '', 0, 1));

        // Si no hay apellido, usar solo la primera letra del nombre
        if (empty($this->apellido)) {
            $iniciales = strtoupper(substr($this->name, 0, 1));
        }

        return "https://ui-avatars.com/api/?name={$iniciales}&background=d82128&color=fff&size=200&bold=true";
    }

    /**
     * Obtener nombre completo
     */
    public function getNombreCompletoAttribute(): string
    {
        return trim($this->name . ' ' . $this->apellido);
    }

    /**
     * Relación: Un usuario tiene una empresa
     */
    public function empresa()
    {
        return $this->hasOne(Empresa::class);
    }

    public function getEmpresaOrCreate()
    {
        if (!$this->empresa) {
            return Empresa::create([
                'user_id' => $this->id,
                'nombre' => 'Mi Carwash',
                'direccion' => null,
                'telefono' => null,
                'logo' => null
            ]);
        }

        return $this->empresa;
    }
}