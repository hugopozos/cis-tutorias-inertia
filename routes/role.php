<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('roles/edit/{role}', [RoleController::class, 'update'])->name('roles.update');
