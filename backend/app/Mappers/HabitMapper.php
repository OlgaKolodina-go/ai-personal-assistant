<?php 

namespace App\Mappers;

use App\Models\Habit;
use App\DTO\ViewHabitDto;
use App\DTO\ScheduleDto;
use App\DTO\ReminderDto;

final class HabitMapper
{
    public static function toViewDto(Habit $habit): ViewHabitDto
    {
        return new ViewHabitDto(
            id: $habit->id,
            userId: $habit->user_id,
            title: $habit->title,
            category: $habit->category,
            description: $habit->description,
            active: (bool) $habit->active,
            schedule: $habit->schedule
                ? new ScheduleDto(
                    id: $habit->schedule->id,
                    time: $habit->schedule->time,
                    daysOfWeek: $habit->schedule->days_of_week,
                    timezone: $habit->schedule->timezone,
                )
                : null,
            reminder: $habit->reminder 
                ? new ReminderDto( 
                    id: $habit->reminder->id, 
                    enabled: (bool) $habit->reminder->enabled, 
                    channel: $habit->reminder->channel, 
                ) 
                : null,
        );
    }
}