<?php

namespace App\DTO;

final class CreateReminderDto
{
    public function __construct(
        public readonly bool $enabled,
        public readonly ?string $channel,
    ) {}
}