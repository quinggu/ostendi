<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Goal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Employee::factory()->create([
            'email' => 'test@example.com',
        ]);

        Goal::factory()->create([
            'name' => 'test',
            'progress' => 0,
        ]);
    }
}
