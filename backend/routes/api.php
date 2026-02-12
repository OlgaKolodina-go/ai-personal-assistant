<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\HabitController;


// Habits CRUD
Route::apiResource('habits', HabitController::class);

// Log completion
Route::post('habits/{habit}/log', [ActivityLogController::class, 'store']);

// Daily overview
Route::get('day/{date}', [DayController::class, 'show']);

