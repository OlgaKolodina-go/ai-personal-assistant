<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateHabitRequest;
use App\Http\Requests\StoreHabitRequest;
use App\Services\HabitService;
use App\Http\Resources\HabitResource;
use Illuminate\Http\Request;
use App\DTO\CreateHabitDto;
use App\DTO\UpdateHabitDto;
use App\DTO\UpdateScheduleDto;
use App\DTO\CreateScheduleDto;
use App\DTO\CreateReminderDto;

class HabitController extends Controller
{
    public function __construct(
        private HabitService $habitService
    ) {}

    public function show(int $habit, Request $request)
    {
        $userId = 1; //$userId = $request->user()->id;
        
        $dto = $this->habitService->getHabit($habit, $userId);

        return new HabitResource($dto);
    }

    public function index(Request $request)
    {
        $userId = 1; //$userId = $request->user()->id;

        $dtos = $this->habitService->getHabitsForUser($userId);

        return HabitResource::collection($dtos);
    }

    public function store(StoreHabitRequest $request)
    {
        $data = $request->validated();

        $scheduleDto = new CreateScheduleDto(
            time: $data['schedule']['time'],
            daysOfWeek: $data['schedule']['days_of_week'],
            timezone: $data['schedule']['timezone'],
        );

        $reminderDto = isset($data['reminder'])
            ? new CreateReminderDto(
                enabled: $data['reminder']['enabled'] ?? false,
                channel: $data['reminder']['channel'] ?? null,
            )
            : null;

        $dto = new CreateHabitDto(
            userId: 1, //$request->user()->id,
            title: $data['title'],
            category: $data['category'],
            description: $data['description'] ?? null,
            schedule: $scheduleDto,
            reminder: $reminderDto,
        );

        $habit = $this->habitService->create($dto);

        return new HabitResource($habit);
    }

    public function update(int $habit, UpdateHabitRequest $request) 
    {
        $dto = new UpdateHabitDto(
            title: $request->title,
            category: $request->category,
            description: $request->description,
            active: $request->active,
            schedule: $request->schedule
                ? new UpdateScheduleDto(
                    time: $request->schedule['time'] ?? null,
                    daysOfWeek: $request->schedule['days_of_week'] ?? null,
                    timezone: $request->schedule['timezone'] ?? null,
                )
                : null
        );

        $result = $this->habitService->update(
            $habit,
            $request->user()->id,
            $dto
        );

        return new HabitResource($result);
    }

    public function destroy(int $habit, Request $request)
    {
        $this->habitService->delete($habit, $request->user()->id);

        return response()->noContent();
    }
}