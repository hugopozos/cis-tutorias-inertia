<?php

use App\Enums\ClassroomTypeEnum;
use App\Enums\ScheduleStatusEnum;
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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('NOMBRE DEL HORARIO');
            $table->string('description', 50)->nullable()->comment('BREVE DESCRIPCIÓN DEL HORARIO');
            $table->string('classroom_type')->default(ClassroomTypeEnum::IN_PERSON)->comment('TIPO DE AULA');
            $table->string('classroom_location')->comment('UBICACIÓN DEL AULA, URL O SALON');
            $table->date('start_date')->comment('FECHA DE INICIO');
            $table->date('end_date')->comment('FECHA DE FIN');
            $table->time('start_time')->nullable()->comment('HORA DE INICIO');
            $table->longText('days_of_week')->nullable()->comment('DÍAS DE LA SEMANA');
            $table->integer('max_students')->nullable()->comment('CANTIDAD MÁXIMA DE ESTUDIANTES');
            $table->string('status')->default(ScheduleStatusEnum::AVAILABLE)->comment('ESTADO DEL HORARIO OFRECIDO');
            $table->foreignId('course_id')->references('id')->on('courses');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
