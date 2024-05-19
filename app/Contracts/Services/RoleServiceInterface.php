<?php

namespace App\Contracts\Services;

interface RoleServiceInterface
{
    /**
     * Crea un nuevo rol.
     */
    public function create($request);

    /**
     * Actualiza un rol existente.
     */
    public function update($request, $role);

}
