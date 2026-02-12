<?php

namespace App\DTO;

final class UpdateScheduleDto
{
    public function __construct(
        public readonly ?string $time,
        public readonly ?array $daysOfWeek,
        public readonly ?string $timezone,
    ) {}
}