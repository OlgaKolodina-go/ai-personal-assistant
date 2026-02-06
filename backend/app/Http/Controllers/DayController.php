<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\ActivityLog;

class DayController extends Controller
{
    public function show(string $date)
    {
        $userId = 1; // временно, потом будет auth

        $habits = Habit::query()
            ->where('user_id', $userId)
            ->where('active', true)
            ->with('schedules')
            ->get();

        $logs = ActivityLog::query()
            ->whereDate('date', $date)
            ->get()
            ->keyBy('habit_id');

        $items = [];
        $summary = [
            'done' => 0,
            'skipped' => 0,
            'unknown' => 0,
        ];

        foreach ($habits as $habit) {
            foreach ($habit->schedules as $schedule) {
                $log = $logs->get($habit->id);

                $status = $log->status ?? 'unknown';

                $summary[$status]++;

                $items[] = [
                    'habit_id' => $habit->id,
                    'title' => $habit->title,
                    'category' => $habit->category,
                    'time' => $schedule->time,
                    'status' => $status,
                ];
            }
        }

        usort($items, fn ($a, $b) => strcmp($a['time'], $b['time']));

        return response()->json([
            'date' => $date,
            'summary' => $summary,
            'habits' => $items,
        ]);
    }
}