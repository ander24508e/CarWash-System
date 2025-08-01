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
        Schema::create('model_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name_model');
            $table->foreignId('brand')->constrained('marca_vehiculos'); // Nombre exacto de la tabla
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_vehiculos');
    }
};
