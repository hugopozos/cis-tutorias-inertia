<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reiniciar el cache de permisos
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $user_permissions = [
            'ver todos los usuarios',
            'ver usuario',
            'crear usuario',
            'editar usuario',
            'eliminar usuario',
            'ver rol',
            'ver todos los cursos',
            'ver curso',
            'ver todas las carreras',
            'ver carrera',
            'ver todas las tutorias',
            'ver tutoria',
            'crear tutoria',
            'editar tutoria',
            'eliminar tutoria',
            'ver todos los registros de tutorias',
            'ver registro de tutoria',
            'registrarse en tutoria',
            'cambiar registro en tutoria',
            'crear registro de tutoria',
            'editar registro de tutoria',
            'eliminar registro de tutoria'
        ];

        $admin_permissions = [
            'ver todos los usuarios',
            'ver usuario',
            'crear usuario',
            'editar usuario',
            'eliminar usuario',
            'ver todos los roles',
            'ver rol',
            'crear role',
            'editar role',
            'eliminar role',
            'ver todos los cursos',
            'ver curso',
            'crear curso',
            'editar curso',
            'eliminar curso',
            'ver todas las carreras',
            'ver carrera',
            'crear carrera',
            'editar carrera',
            'eliminar carrera',
            'ver todas las tutorias',
            'ver tutoria',
            'crear tutoria',
            'editar tutoria',
            'eliminar tutoria',
            'ver todos los registros de tutorias',
            'ver registro de tutoria',
            'registrarse en tutoria',
            'cambiar registro en tutoria',
            'crear registro de tutoria',
            'editar registro de tutoria',
            'eliminar registro de tutoria'
        ];

        foreach ($user_permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        foreach ($admin_permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }

        // Roles para los usuarios del sistema (Estudiantes)
        $role1 = Role::create(['name' => 'estudiante', 'guard_name' => 'web']);
        $role1->givePermissionTo('ver todos los usuarios',
            'ver usuario',
            'ver todos los cursos',
            'ver curso',
            'ver todas las carreras',
            'ver carrera',
            'ver todas las tutorias',
            'ver tutoria',
            'ver todos los registros de tutorias',
            'ver registro de tutoria',
            'registrarse en tutoria',
            'cambiar registro en tutoria',
        );

        $role2 = Role::create(['name' => 'tutor', 'guard_name' => 'web']);
        $role2->givePermissionTo('ver todos los usuarios',
            'ver usuario',
            'ver todos los cursos',
            'ver curso',
            'ver todas las carreras',
            'ver carrera',
            'ver todas las tutorias',
            'ver tutoria',
            'crear tutoria',
            'editar tutoria',
            'eliminar tutoria',
            'ver todos los registros de tutorias',
            'ver registro de tutoria',
            'registrarse en tutoria',
            'cambiar registro en tutoria',
            'crear registro de tutoria',
            'editar registro de tutoria',
            'eliminar registro de tutoria',
        );

        // Roles para los administradores del sistema
        $role = Role::create(['name' => 'super admin', 'guard_name' => 'admin']);
        $admin_permissions = Permission::where('guard_name', 'admin')->get();
        $role->syncPermissions($admin_permissions);

    }
}
