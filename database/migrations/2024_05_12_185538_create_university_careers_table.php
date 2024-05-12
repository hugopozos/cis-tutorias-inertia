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
        Schema::create('university_careers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('NOMBRE DE LA CARRERA');
            $table->boolean('active')->default(true)->comment('ESTADO DE LA CARRERA, ACTIVA O INACTIVA');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
