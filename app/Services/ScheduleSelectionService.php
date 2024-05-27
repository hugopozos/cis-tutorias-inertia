<?php

namespace App\Services;

use App\Contracts\Services\ScheduleSelectionServiceInterface;
use App\Enums\ScheduleStatusEnum;
use App\Models\Schedule;
use App\Models\ScheduleSelection;
use Illuminate\Http\Request;

class ScheduleSelectionService implements ScheduleSelectionServiceInterface
{
    public function create(Request $request, Schedule $schedule)
    {
        if (ScheduleSelection::where('user_id', $request->user()->id)
            ->where('schedule_id', $schedule->id)
            ->where('active', false)
            ->exists()
        ){
            session()->flash('message', [
                'type' => 'error',
                'title' => 'Horario ya seleccionado',
                'message' => 'Tu asistencia fue removida',
            ]);

            return;
        }

        if (ScheduleSelection::where('user_id', $request->user()->id)
            ->where('schedule_id', $schedule->id)
            ->exists()
        ){
            session()->flash('message', [
                'type' => 'warning',
                'title' => 'Horario ya seleccionado',
                'message' => 'Ya has seleccionado este horario',
            ]);

            return;
        }

        // Verificar si el horario está lleno antes de crear la selección
        $registeredUsersCount = ScheduleSelection::where('schedule_id', $schedule->id)
            ->where('active', true)
            ->count();

        if ($registeredUsersCount >= $schedule->max_students) {
            session()->flash('message', [
                'type' => 'warning',
                'title' => 'Límite alcanzado',
                'message' => 'Este horario ya ha alcanzado el límite de estudiantes',
            ]);

            return;
        }

        // Crear la selección del horario
        ScheduleSelection::create([
            'schedule_id' => $schedule->id,
            'user_id' => $request->user()->id,
        ]);

        // Verificar si el usuario es el último en registrarse y actualizar el estado del horario
        if ($registeredUsersCount + 1 >= $schedule->max_students) {
            $schedule->update(['status' => ScheduleStatusEnum::FULL]);
        }

        session()->flash('message', [
            'type' => 'success',
            'title' => 'Horario seleccionado',
            'message' => 'Horario seleccionado correctamente',
        ]);
    }

    public function removeAttendance(Request $request, ScheduleSelection $scheduleSelection)
    {
        $scheduleSelection->active = false;
        $scheduleSelection->save();

        session()->flash('message', [
            'type' => 'success',
            'title' => 'Asistencia removida',
            'message' => 'Ya no formas parte de esta tutoría',
        ]);
    }



}
