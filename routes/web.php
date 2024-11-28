<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/show', function () {

    $employees = Employee::all();
    return view('show', compact('employees'));

});
