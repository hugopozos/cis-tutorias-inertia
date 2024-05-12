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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->comment('NOMBRES DEL ESTUDIANTE');
            $table->string('last_name')->comment('APELLIDOS DEL ESTUDIANTE');
            $table->string('email')->unique()->comment('CORREO INSTITUCIONAL');
            $table->timestamp('email_verified_at')->nullable()->comment('FECHA DE VERIFICACIÓN DE CORREO');
            $table->string('password')->comment('CONTRASEÑA');
            $table->date('birthday')->nullable()->comment('FECHA DE NACIMIENTO');
            $table->string('student_number')->unique()->comment('NÚMERO DE CONTROL');
            $table->string('university_career')->comment('CARRERA DEL ESTUDIANTE');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
