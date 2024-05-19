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

}
