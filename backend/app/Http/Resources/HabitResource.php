<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\DTO\ViewHabitDto;

class HabitResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var ViewHabitDto $dto */
        $dto = $this->resource;

        return [
            'id' => $dto->id,
            'user_id' => $dto->userId,
            'title' => $dto->title,
            'category' => $dto->category,
            'description' => $dto->description,
            'active' => $dto->active,
            'schedule' => $dto->schedule ? [
                'id' => $dto->schedule->id,
                'time' => $dto->schedule->time,
                'days_of_week' => $dto->schedule->daysOfWeek,
                'timezone' => $dto->schedule->timezone,
            ] : null,
        ];
    }
}
