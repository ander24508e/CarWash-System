<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            
            // Cliente que compra (puede ser NULL si es venta en mostrador)
            $table->foreignId('cliente_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            
            // Empleado/Usuario que realiza la venta (SIEMPRE tiene valor)
            $table->foreignId('empleado_id')
                ->constrained('users')
                ->onDelete('cascade');
            
            $table->string('product');
            $table->string('service');
            $table->string('description');
            $table->decimal('total', 10, 2);
            $table->date('fecha_venta');
            $table->text('detalles')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index('cliente_id');
            $table->index('empleado_id');
            $table->index('fecha_venta');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};