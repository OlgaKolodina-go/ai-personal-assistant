<?php

namespace App\DTO;

use App\DTO\ScheduleDto;
use App\DTO\ReminderDto;

final class ViewHabitDto
{
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
        public readonly string $title,
        public readonly string $category,
        public readonly ?string $description,
        public readonly bool $active,
        public readonly ?ScheduleDto $schedule,
        public readonly ?ReminderDto $reminder,
    ) {}
}
