<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['name' => 'Fundamentos de Programación', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Programación Orientada a Objetos', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Estructura de Datos', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Fundamentos de Base de Datos', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Taller de Base de Datos', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Administración de Base de Datos', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Tópicos Avanzados de Programación', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Sistemas Operativos', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Taller de Sistemas Operativos', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Fundamentos de Ingeniería de Software', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Ingeniería de Software', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Gestión de Proyectos de Software', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Fundamentos de Telecomunicaciones', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Redes de Computadoras', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Conmutación y Enrutamiento en Redes de Datos', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Administración de Redes', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Desarrollo Web', 'is_active' => true, 'university_career_id' => 8],
            ['name' => 'Inteligencia Artificial', 'is_active' => true, 'university_career_id' => 8],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
