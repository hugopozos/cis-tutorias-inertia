<?php

namespace App\Services;

use App\Contracts\Services\RoleServiceInterface;
use App\Models\Permission;
use App\Models\Role;

class RoleService implements RoleServiceInterface
{
    public function create($request)
    {
        $request->validated();

        $role = Role::create($request->only('name', 'guard_name'));

        $permissions = array_column($request['permissions'], 'id');

        $role->permissions()->sync($permissions);
    }

    public function update($request, $role)
    {
        $request->validated();

        $role->update($request->only('name'));

        $permissions = array_column($request['permissions'], 'id');

        $role->permissions()->sync($permissions);
    }

    /**
     * @throws \Exception
     */
    public function delete($role)
    {
        if (in_array($role->name, ['estudiante', 'tutor', 'super admin'])) {
            abort(403, 'No puedes eliminar este rol');
        }

        // Lógica para cambiar el rol de los usuarios que tengan el rol a eliminar por el rol por defecto
        $default_role = Role::where('name', 'estudiante')->first();
        if ($role->users()->count() > 0) {
            foreach ($role->users as $user) {
                $user->roles()->detach($role->id);
                $user->roles()->attach($default_role->id);
            }
        }

        $role->delete();
    }

}
