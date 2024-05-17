<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles para los usuarios del sistema (Estudiantes)
        Role::create(['name' => 'estudiante', 'guard_name' => 'web']);
        Role::create(['name' => 'tutor', 'guard_name' => 'web']);

        // Roles para los administradores del sistema
        Role::create(['name' => 'super-admin', 'guard_name' => 'admin']);
        Role::create(['name' => 'admin', 'guard_name' => 'admin']);
    }
}
