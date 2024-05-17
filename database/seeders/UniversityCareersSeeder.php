<?php

namespace Database\Seeders;

use App\Models\UniversityCareer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversityCareersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $careers = [
            ['name' => 'Licenciatura en Administración', 'is_active' => true],
            ['name' => 'Ingeniería Bioquímica', 'is_active' => true],
            ['name' => 'Ingeniería Eléctrica', 'is_active' => true],
            ['name' => 'Ingeniería Electrónica', 'is_active' => true],
            ['name' => 'Ingeniería Industrial', 'is_active' => true],
            ['name' => 'Ingeniería Mecatrónica', 'is_active' => true],
            ['name' => 'Ingeniería Mecánica', 'is_active' => true],
            ['name' => 'Ingeniería en Sistemas Computacionales', 'is_active' => true],
            ['name' => 'Ingeniería Química', 'is_active' => true],
            ['name' => 'Ingeniería en Energías Renovables', 'is_active' => true],
            ['name' => 'Ingeniería en Gestión Empresarial', 'is_active' => true],
        ];

        foreach ($careers as $career) {
            UniversityCareer::create($career);
        }
    }
}
