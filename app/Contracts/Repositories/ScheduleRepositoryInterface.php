<?php

namespace App\Contracts\Repositories;

interface ScheduleRepositoryInterface
{
    /**
     * Obtiene todos los registros de la tabla.
     */
    public function all();

    /**
     * Obtiene los horarios de un usuario.
     */
    public function getSchedulesByUserId($userId);

}
