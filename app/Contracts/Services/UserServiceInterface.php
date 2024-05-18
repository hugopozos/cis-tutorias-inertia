<?php

namespace App\Contracts\Services;

interface UserServiceInterface
{
    /**
     * Actualiza información de un usuario
     */
    public function update($request, $user);
}
