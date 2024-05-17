<?php

namespace App\Contracts\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Obtiene todos los usuarios.
     */
    public function all();

    /**
     * Obtiene los filtros de los usuarios.
     */
    public function getFilters();

    /**
     * Obtiene un usuario por su id.
     */
    public function findById($request);

}
