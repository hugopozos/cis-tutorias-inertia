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
            ['name' => 'Fundamentos de Programación', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Programación Orientada a Objetos', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Estructura de Datos', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Fundamentos de Base de Datos', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Taller de Base de Datos', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Administración de Base de Datos', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Tópicos Avanzados de Programación', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Sistemas Operativos', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Taller de Sistemas Operativos', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Fundamentos de Ingeniería de Software', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Ingeniería de Software', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Gestión de Proyectos de Software', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Fundamentos de Telecomunicaciones', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Redes de Computadoras', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Conmutación y Enrutamiento en Redes de Datos', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Administración de Redes', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Desarrollo Web', 'active' => true, 'university_career_id' => 8],
            ['name' => 'Inteligencia Artificial', 'active' => true, 'university_career_id' => 8],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
