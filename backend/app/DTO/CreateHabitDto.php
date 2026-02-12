<?php

namespace App\DTO;

use App\DTO\CreateScheduleDto;
use App\DTO\CreateReminderDto;

final class CreateHabitDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $title,
        public readonly string $category,
        public readonly ?string $description,
        public readonly ?CreateScheduleDto $schedule,
        public readonly ?CreateReminderDto $reminder,
    ) {}
}