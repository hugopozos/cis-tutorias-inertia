<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CourseRepositoryInterface;
use App\Contracts\Repositories\ScheduleRepositoryInterface;
use App\Contracts\Services\ScheduleServiceInterface;
use App\Enums\ClassroomTypeEnum;
use App\Http\Requests\CreateScheduleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function __construct(
        protected readonly CourseRepositoryInterface $courseRepository,
        protected readonly ScheduleServiceInterface $scheduleService,
        protected readonly ScheduleRepositoryInterface $scheduleRepository,
    ){}
    /**
     * Muestra una vista con la lista de horarios.
     */
    public function index()
    {
        return Inertia::render('Schedules/Index');
    }

    /**
     * Muestra una vista con el formulario para crear un nuevo horario.
     */
    public function create()
    {
        return Inertia::render('Schedules/Create', [
            'courses' => $this->courseRepository->all(),
            'userSchedules' => $this->scheduleRepository->getSchedulesByUserId(auth()->user()->id),
            'classroomTypes' => ClassroomTypeEnum::getValues(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateScheduleRequest $request)
    {
        $this->scheduleService->create($request);
        return Redirect::route('schedules.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
