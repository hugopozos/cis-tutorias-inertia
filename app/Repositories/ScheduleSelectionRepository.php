<?php

namespace App\Repositories;

use App\Contracts\Repositories\ScheduleSelectionRepositoryInterface;
use App\Models\ScheduleSelection;
use Illuminate\Support\Facades\Request;

class ScheduleSelectionRepository implements ScheduleSelectionRepositoryInterface
{
    public function getUserScheduleSelections()
    {
        return ScheduleSelection::where('user_id', Request::user()->id)
            ->with(['schedule', 'schedule.course'])
            ->get();
    }

}
