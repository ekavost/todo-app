<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/', [TaskController::class, 'create']);
Route::get('api/tasks', [TaskController::class, 'show']);
