<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UserController::class, 'show'])->name('users.show');
//Route::get('users/create', [UserController::class, 'create'])->name('users.create');
//Route::post('users', [UserController::class, 'store'])->name('users.store');

Route::get('users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/edit/{user}', [UserController::class, 'update'])->name('users.update');

