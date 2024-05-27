<?php

use App\Http\Controllers\ScheduleSelectionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('schedules/selections', [ScheduleSelectionController::class, 'index'])->name('schedule_selection.index');
    Route::post('schedules/{schedule}/register', [ScheduleSelectionController::class, 'store'])->name('schedule_selection.store');
    Route::put('schedules/{scheduleSelection}/remove-attendance', [ScheduleSelectionController::class, 'removeAttendance'])->name('schedule_selection.removeAttendance');

});
