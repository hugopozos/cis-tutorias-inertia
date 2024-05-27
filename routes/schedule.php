<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleSelectionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('schedules/{schedule}/list', [ScheduleController::class, 'list'])->name('schedules.list');
    Route::get('schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::put('schedules/{schedule}/cancel', [ScheduleController::class, 'cancel'])->name('schedules.cancel');
});

