<?php

namespace App\Services;

use App\Models\Habit;
use Illuminate\Support\Facades\DB;
use App\Repositories\HabitRepository;
use App\Dto\ViewHabitDto;
use App\Mappers\HabitMapper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Dto\CreateHabitDto;
use App\Dto\UpdateHabitDto;

class HabitService
{
    public function __construct(
        private HabitRepository $habitRepository
    ) {}

    public function getHabit(int $habitId, int $userId): ViewHabitDto
    {
        $habit = $this->habitRepository->findByIdForUser($habitId, $userId);

        if (!$habit) {
            throw new ModelNotFoundException('Habit not found');
        }

        return HabitMapper::toViewDto($habit);
    }

    public function getHabitsForUser(int $userId): array
    {
        $habits = $this->habitRepository->getAllForUser($userId);

        return array_map(
            fn ($habit) => HabitMapper::toViewDto($habit),
            $habits->all()
        );
    }

    public function create(CreateHabitDto $dto): ViewHabitDto
    {
        return DB::transaction(function () use ($dto) {

            $habit = $this->habitRepository->create($dto);

            if ($dto->schedule) {
                $this->habitRepository->createSchedule(
                    $habit,
                    $dto->schedule
                );
            }

            if ($dto->reminder) {
                $this->habitRepository->createReminder(
                    $habit,
                    $dto->reminder
                );
            }

            return HabitMapper::toViewDto(
                $habit->load('schedule', 'reminder')
            );
        });
    }

    public function update(int $habitId, int $userId, UpdateHabitDto $dto): ViewHabitDto 
    {
        return DB::transaction(function () use ($habitId, $userId, $dto) {

            $habit = $this->habitRepository
                ->findByIdForUser($habitId, $userId);

            if (!$habit) {
                throw new ModelNotFoundException();
            }

            $this->habitRepository->update($habit, $dto);

            if ($dto->schedule) {
                $this->habitRepository
                    ->updateOrCreateSchedule($habit, $dto->schedule);
            }

            return HabitMapper::toViewDto(
                $habit->refresh()->load('schedule')
            );
        });
    }

    public function delete(int $habitId, int $userId): void
    {
        $habit = $this->habitRepository->findByIdForUser($habitId, $userId);

        if (!$habit) {
            throw new ModelNotFoundException();
        }

        $habit->delete();
    }
}