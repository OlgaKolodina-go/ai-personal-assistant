<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function store(Request $request, Habit $habit)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'status' => ['required', 'in:done,skipped,unknown'],
            'source' => ['nullable', 'string'],
        ]);

        $log = ActivityLog::updateOrCreate(
            [
                'habit_id' => $habit->id,
                'date' => $validated['date'],
            ],
            [
                'status' => $validated['status'],
                'done_at' => $validated['status'] === 'done'
                    ? now()
                    : null,
                'source' => $validated['source'] ?? 'manual',
            ]
        );

        return response()->json($log);
    }
}
