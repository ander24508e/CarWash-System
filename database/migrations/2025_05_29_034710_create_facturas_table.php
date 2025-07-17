<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer')->constrained('clientes', 'id');
            $table->string('identification')->constrained('clientes', 'identification');
            $table->string('date');
            $table->string('address');
            $table->string('discount');
            $table->string('description'); //producto o servicio
            $table->string('precio_subtotal');
            $table->string('precio_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
