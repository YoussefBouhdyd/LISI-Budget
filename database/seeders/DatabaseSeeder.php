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
        ]);
        LineBudget::factory()->create([
            'name' => "Achats de petit outillage et petit équipement",
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de fournitures informatiques",
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de fournitures de bureau, papeterie et imprimés",
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de matières premières",
        ]);
        LineBudget::factory()->create([
            'name' => "Frais de transport du personnel et des étudiants à l'étranger",
        ]);
        LineBudget::factory()->create([
            'name' => "Indemnités de déplacement à l'intérieur du Royaume",
        ]);
        LineBudget::factory()->create([
            'name' => "Indemnités kilométriques",
        ]);
        LineBudget::factory()->create([
            'name' => "Indemnités de mission à l'étranger",
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de carburants",
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de matériel scientifique",
        ]);
        LineBudget::factory()->create([
            'name' => "Achat de matériel informatique",
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
    }
}
