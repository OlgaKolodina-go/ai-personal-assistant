<?php

namespace App\DTO;

use App\DTO\UpdateScheduleDto;

final class UpdateHabitDto
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $category,
        public readonly ?string $description,
        public readonly ?bool $active,
        public readonly ?UpdateScheduleDto $schedule,
    ) {}
}