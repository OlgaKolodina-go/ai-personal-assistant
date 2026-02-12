<?php

namespace App\Repositories;

use App\Models\Habit;
use App\Dto\CreateHabitDto;
use App\Dto\CreateScheduleDto;
use App\Dto\CreateReminderDto;
use App\Dto\UpdateScheduleDto;
use App\Dto\UpdateHabitDto;

class HabitRepository
{
    public function findByIdForUser(int $habitId, int $userId): ?Habit
    {
        return Habit::query()
            ->with('schedule')
            ->where('id', $habitId)
            ->where('user_id', $userId)
            ->first();
    }

    public function getAllForUser(int $userId)
    {
        return Habit::query()
            ->with('schedule')
            ->where('user_id', $userId)
            ->get();
    }

    public function create(CreateHabitDto $dto): Habit
    {
        return Habit::create([
            'user_id' => $dto->userId,
            'title' => $dto->title,
            'category' => $dto->category,
            'description' => $dto->description,
            'active' => true,
        ]);
    }

    public function update(Habit $habit, UpdateHabitDto $dto): void
    {
        $habit->update(array_filter([
            'title' => $dto->title,
            'category' => $dto->category,
            'description' => $dto->description,
            'active' => $dto->active,
        ], fn ($value) => $value !== null));
    }

    public function createSchedule(Habit $habit, CreateScheduleDto $dto): void
    {
        $habit->schedule()->create([
            'time' => $dto->time,
            'days_of_week' => $dto->daysOfWeek,
            'timezone' => $dto->timezone,
        ]);
    }

    public function updateOrCreateSchedule(Habit $habit, UpdateScheduleDto $dto): void 
    {
        $habit->schedule()->updateOrCreate(
            [],
            array_filter([
                'time' => $dto->time,
                'days_of_week' => $dto->daysOfWeek,
                'timezone' => $dto->timezone,
            ], fn ($v) => $v !== null)
        );
    }

    public function createReminder(Habit $habit, CreateReminderDto $dto): void 
    { 
        $habit->reminder()->create([ 
            'enabled' => $dto->enabled, 
            'channel' => $dto->channel, 
        ]);
    }
}