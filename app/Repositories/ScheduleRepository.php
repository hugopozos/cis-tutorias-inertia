<?php

namespace App\Repositories;

use App\Contracts\Repositories\ScheduleRepositoryInterface;
use App\Models\Schedule;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    public function all()
    {
        return Schedule::all();
    }

    public function getSchedulesByUserId($userId)
    {
        return Schedule::where('user_id', $userId)->get();
    }

}
