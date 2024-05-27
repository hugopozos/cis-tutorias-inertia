<?php

namespace App\Repositories;

use App\Contracts\Repositories\ScheduleRepositoryInterface;
use App\Enums\ScheduleStatusEnum;
use App\Models\Schedule;
use Illuminate\Http\Client\Request;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    public function all()
    {
        return Schedule::all();
    }

    public function getAvailableSchedules($request)
    {
        $user_id = $request->user()->id;

        return Schedule::whereIn('status', [ScheduleStatusEnum::AVAILABLE, ScheduleStatusEnum::FULL])
            ->with(['user', 'selections' => function ($query) use ($user_id) {
                $query->where('user_id', $user_id)
                    ->where('active', true); // Filtra solo los registros activos
            }])
            ->withCount(['selections' => function ($query) {
                $query->where('active', true); // Cuenta solo los registros activos
            }])
            ->get()
            ->map(function ($schedule) use ($user_id) {
                $schedule->is_registered = $schedule->selections->isNotEmpty();
                $schedule->was_registered = $schedule->selections->where('user_id', $user_id)->where('active', false)->isNotEmpty();
                $schedule->registered_users_count = $schedule->selections_count;
                return $schedule;
            });
    }

    public function getSchedulesByUserId($user_id)
    {
        return Schedule::where('user_id', $user_id)->get();
    }

    public function getScheduleSelections($schedule)
    {
        return $schedule->selections()->with('user')->get();
    }



}
