<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'timezone' => 'UTC',
        ]);
    }
}
