<?php

namespace App\DTO;

class ReminderDto
{
    public function __construct(
        public readonly int $id,
        public readonly bool $enabled,
        public readonly string $channel,
    ) {}
}