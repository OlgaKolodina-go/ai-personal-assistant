<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitActivityController;
use App\Http\Controllers\DayController;

Route::post('/habits/{habit}/log', [HabitActivityController::class, 'store']);

Route::get('/day/{date}', [DayController::class, 'show']);