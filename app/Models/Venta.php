<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    
    protected $table = 'ventas';
    
    protected $fillable = [
        'cliente_id',
        'empleado_id',
        'product',
        'service',
        'description',
        'total',
        'fecha_venta',
        'detalles'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'fecha_venta' => 'date',
    ];

    // =============================================
    // RELACIONES
    // =============================================

    /**
     * Cliente que compró (puede ser NULL)
     */
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id', 'id');
    }

    /**
     * Empleado que realizó la venta (SIEMPRE tiene valor)
     */
    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id', 'id');
    }
}