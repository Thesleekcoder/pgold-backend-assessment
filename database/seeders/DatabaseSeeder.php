<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RateSeeder; // ← Added
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user (optional but helpful)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed admin-defined rates
        $this->call(RateSeeder::class);
    }
}