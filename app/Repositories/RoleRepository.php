<?php

namespace App\Repositories;

use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::all();
    }

    public function getUserRoles()
    {
        return Role::where('guard_name', 'web')->get();
    }

    public function getAdminRoles()
    {
        return Role::where('guard_name', 'admin')->get();
    }

}
