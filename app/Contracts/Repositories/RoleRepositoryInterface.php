<?php

namespace App\Contracts\Repositories;

interface RoleRepositoryInterface
{
    /**
     * Obtener todos los roles.
     */
    public function all();

    /**
     * Obtener los roles de usuario.
     */
    public function getUserRoles();

    /**
     * Obtener los roles de administrador.
     */
    public function getAdminRoles();

}
