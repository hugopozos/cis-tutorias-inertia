<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {

});

require __DIR__ . '/auth/adminauth.php';
