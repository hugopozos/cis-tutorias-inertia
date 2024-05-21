<?php

namespace App\Services;

use App\Contracts\Services\ScheduleServiceInterface;
use App\Enums\ScheduleStatusEnum;
use App\Models\Schedule;

class ScheduleService implements ScheduleServiceInterface
{
    public function __construct(){}

    public function create($request)
    {
        $request->validated();

        Schedule::create([
            'name' => $request->name,
            'description' => $request->description,
            'classroom_type' => $request->classroom_type,
            'classroom_location' => $request->classroom_location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'days_of_week' => json_encode($request->days_of_week),
            'max_students' => $request->max_students,
            'status' => ScheduleStatusEnum::AVAILABLE,
            'course_id' => $request->course,
            'user_id' => $request->user()->id,
        ]);
    }

}
