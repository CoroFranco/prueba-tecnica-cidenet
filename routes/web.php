<?php

use App\Http\Controllers\AdminController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/show', [AdminController::class, 'search'])-> name ('searchEmployee');

