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
            ['name' => 'Licenciatura en Administración', 'active' => true],
            ['name' => 'Ingeniería Bioquímica', 'active' => true],
            ['name' => 'Ingeniería Eléctrica', 'active' => true],
            ['name' => 'Ingeniería Electrónica', 'active' => true],
            ['name' => 'Ingeniería Industrial', 'active' => true],
            ['name' => 'Ingeniería Mecatrónica', 'active' => true],
            ['name' => 'Ingeniería Mecánica', 'active' => true],
            ['name' => 'Ingeniería en Sistemas Computacionales', 'active' => true],
            ['name' => 'Ingeniería Química', 'active' => true],
            ['name' => 'Ingeniería en Energías Renovables', 'active' => true],
            ['name' => 'Ingeniería en Gestión Empresarial', 'active' => true],
        ];

        foreach ($careers as $career) {
            UniversityCareer::create($career);
        }
    }
}
