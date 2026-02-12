<?php

namespace App\DTO;

final class ScheduleDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $time,
        public readonly array $daysOfWeek,
        public readonly string $timezone,
    ) {}
}