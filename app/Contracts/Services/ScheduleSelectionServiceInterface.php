<?php

namespace App\Contracts\Services;

use App\Models\Schedule;
use App\Models\ScheduleSelection;
use Illuminate\Http\Request;

interface ScheduleSelectionServiceInterface
{
    /**
     * Crea un nuevo registro de tutoria
     */
    public function create(Request $request, Schedule $schedule);

    public function removeAttendance(Request $request, ScheduleSelection $scheduleSelection);

}
