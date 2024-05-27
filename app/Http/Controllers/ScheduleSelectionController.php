<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ScheduleRepositoryInterface;
use App\Contracts\Repositories\ScheduleSelectionRepositoryInterface;
use App\Contracts\Services\ScheduleSelectionServiceInterface;
use App\Models\Schedule;
use App\Models\ScheduleSelection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduleSelectionController extends Controller
{
    public function __construct(
        protected readonly ScheduleRepositoryInterface $scheduleRepository,
        protected readonly ScheduleSelectionRepositoryInterface $scheduleSelectionRepository,
        protected readonly ScheduleSelectionServiceInterface $scheduleSelectionService,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ScheduleSelections/Index', [
            'selectedSchedules' => $this->scheduleSelectionRepository->getUserScheduleSelections(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Schedule $schedule)
    {
        $this->scheduleSelectionService->create($request, $schedule);
        return redirect()->back();
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

    public function removeAttendance(Request $request, ScheduleSelection $scheduleSelection)
    {
        $this->scheduleSelectionService->removeAttendance($request, $scheduleSelection);
        return redirect()->back();
    }
}
