<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitActivityController;

Route::post('/habits/{habit}/log', [HabitActivityController::class, 'store']);