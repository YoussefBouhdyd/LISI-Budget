<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\LineBudget;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed Line Budgets Table

        LineBudget::factory()->create([
            'name' => 'Fonctionnement',
        ]);
        LineBudget::factory()->create([
            'name' => 'Investissement',
        ]);
        LineBudget::factory()->create([
            'name' => 'Matériel',
        ]);
        LineBudget::factory()->create([
            'name' => 'Maintenance',
        ]);
        LineBudget::factory()->create([
            'name' => 'Services',
        ]);
        LineBudget::factory()->create([
            'name' => 'Formation',
        ]);

        // Seed Budgets Table

        Budget::factory()->create([
            'amount' => 0,
            'season' => '2024/2025',
        ]);
    }
}
