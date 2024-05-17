<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UserController::class, 'show'])->name('users.show');
//Route::get('users/create', [UserController::class, 'create'])->name('users.create');
//Route::post('users', [UserController::class, 'store'])->name('users.store');

Route::get('users/{user}', [UserController::class, 'edit'])->name('users.edit');

