<?php

namespace App\DTO;

final class CreateScheduleDto
{
    public function __construct(
        public readonly string $time,
        public readonly array $daysOfWeek,
        public readonly string $timezone,
    ) {}
}