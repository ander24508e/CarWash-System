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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name_product');
            $table->foreignId('name_categoria')->constrained('categorias','id');
            $table->string('stock');
            $table->string('description');
            $table->string('brand');
            $table->string('supplier');
            $table->decimal('precio_compra'); //multiplicar por el 30% para el precio de venta
            $table->decimal('precio_venta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
