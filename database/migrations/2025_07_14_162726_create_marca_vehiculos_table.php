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
        Schema::create('marca_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name_brand');
            $table->string('image')->nullable(); // Assuming you want to store an image path
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marca_vehiculos');
    }
};
