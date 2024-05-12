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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('NOMBRE DE LA MATERIA');
            $table->text('description')->nullable()->comment('DESCRIPCIÓN DE LA MATERIA');
            $table->boolean('active')->default(true)->comment('ESTADO DE LA MATERIA');
            $table->foreignId('university_career_id')->references('id')->on('university_careers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
