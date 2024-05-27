<?php

namespace App\Contracts\Repositories;


interface ScheduleRepositoryInterface
{
    /**
     * Obtiene todos los registros de la tabla.
     */
    public function all();

    /**
     * Obtiene los horarios disponibles.
     */
    public function getAvailableSchedules($request);

    /**
     * Obtiene los horarios de un usuario.
     */
    public function getSchedulesByUserId($user_id);

    /**
     * Obtiene las selecciones de un horario.
     */
    public function getScheduleSelections($schedule);

}
