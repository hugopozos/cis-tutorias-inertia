<?php

namespace App\Repositories;

use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all()
    {
        return Permission::all();
    }

    public function getPermissionsByGuard(string $guardName)
    {
        return Permission::where('guard_name', $guardName)->get();
    }

}
