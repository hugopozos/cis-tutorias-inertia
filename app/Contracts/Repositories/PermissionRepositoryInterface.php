<?php

namespace App\Contracts\Repositories;

interface PermissionRepositoryInterface
{
    /**
     * Obtiene todos los permisos.
     */
    public function all();

    /**
     * Obtiene los permisos por guard.
     */
    public function getPermissionsByGuard(string $guardName);
}
