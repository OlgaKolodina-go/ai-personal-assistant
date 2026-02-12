<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Habit;
use App\Http\Resources\HabitResource;

class HabitResourceTest extends TestCase
{
    public function test_habit_resource_structure()
    {
        $habit = Habit::factory()->make();

        $resource = (new HabitResource($habit))->resolve();

        $this->assertArrayHasKey('id', $resource);
        $this->assertArrayHasKey('title', $resource);
        $this->assertArrayHasKey('active', $resource);
    }
}
