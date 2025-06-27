<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\LineBudget;
use App\Models\LineBudgetProposal;
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
            'name' => 'Bachari',
            'email' => 'bachari@lisi-budget.com',
            'role' => 'admin',
            'password' => 'password',
        ]);

        $user = User::factory()->create([
            'name' => 'Youssef',
            'email' => 'Transmitter@lisi-budget.com',
            'role' => 'user',
            'password' => 'password',
        ]);

        // Seed Line Budgets Table

        LineBudget::factory()->create([
            'name' => "Frais de participation et d'inscription aux colloques",
            'code' => 38,
        ]);
        LineBudget::factory()->create([
            'name' => "Achats de petit outillage et petit équipement",
            'code' => 32,
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de fournitures informatiques",
            'code' => 12,
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de fournitures de bureau, papeterie et imprimés",
            'code' => 11,
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de matières premières",
            'code' => 32,
        ]);
        LineBudget::factory()->create([
            'name' => "Frais de transport du personnel et des étudiants à l'étranger",
            'code' => 23,
        ]);
        LineBudget::factory()->create([
            'name' => "Indemnités de déplacement à l'intérieur du Royaume",
            'code' => 21,
        ]);
        LineBudget::factory()->create([
            'name' => "Indemnités kilométriques",
            'code' => 22,
        ]);
        LineBudget::factory()->create([
            'name' => "Indemnités de mission à l'étranger",
            'code' => 25,
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de carburants",
            'code' => 000,
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de matériel scientifique",
            'code' => 13,
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de matériel informatique",
            'code' => 14,
        ]);

        // Seed Line Budget Proposals for the user
        $budgetLines = LineBudget::all();

        $proposals = $budgetLines->map(function ($line) use ($user) {
            return [
                'user_id' => $user->id,
                'budget_line_id' => $line->id,
                'proposed_amount' => 0,
                'spend' => 0,
                'is_validated' => false,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        LineBudgetProposal::insert($proposals->toArray());

        // Seed Budgets Table
        Budget::factory()->create([
            'season' => '2024-2025',
            'amount' => 0,
        ]);
    }
}
