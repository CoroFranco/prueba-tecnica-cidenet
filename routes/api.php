<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AdminController::class, 'store'])->name('register');
Route::delete('/delete/{id}', [AdminController::class, 'deleteEmployee'])->name('deleteEmployee');
Route::put('/edit/{id}', [AdminController::class, 'editEmployee'])->name('editEmployee');
