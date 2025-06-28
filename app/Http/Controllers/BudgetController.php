<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\LineBudget;
use App\Models\LineBudgetProposal;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function loadBudget () {
        $budget = Budget::orderBy('created_at','desc')->first();
        $budgetLines = LineBudget::get();
        return view('budget')
            ->with('budgetLines',$budgetLines)
            ->with("budget",$budget)
            ->with('totalSpend',LineBudgetProposal::sum('spend'));
    }

    public function createBudget(Request $request) {
        $request->validate([
            'budgetAmount' => 'required|numeric',
            'budgetSaison' => 'required|string|max:255',
        ]);

        $budget = new Budget();
        $budget->amount = $request->input('budgetAmount');
        $budget->season = $request->input('budgetSaison');
        $budget->save();

        return redirect()->back()->with('success', 'Budget créé avec succès.');
    }

    public function updateBudget(Request $request) {
        $request->validate([
            'budgetAmount' => 'required|numeric',
            'budgetSeason' => 'required|string|max:255',
            'budgetId' => 'required|exists:budgets,id',
        ]);

        $budget = Budget::find($request->input('budgetId'));
        if ($budget) {
            $budget->amount = $request->input('budgetAmount');
            $budget->season = $request->input('budgetSeason');
            $budget->save();

            return redirect()->back()->with('success', 'Budget mis à jour avec succès.');
        }

        return redirect()->back()->withErrors(['error' => 'Aucun budget trouvé à mettre à jour.']);
    }

    public function addBudgetLine(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|integer',
        ]);

        $lineBudget = new LineBudget();
        $lineBudget->code = $request->input('code');
        $lineBudget->name = $request->input('name');
        $lineBudget->save();

        return redirect()->back()->with('success', 'Ligne budgétaire ajoutée avec succès.');
    }

    public function deleteBudgetLine($id) {
        $lineBudget = LineBudget::find($id);
        if ($lineBudget) {
            $lineBudget->delete();
            return redirect()->back()->with('success', 'Ligne budgétaire supprimée avec succès.');
        }

        return redirect()->back()->withErrors(['error' => 'Aucune ligne budgétaire trouvée à supprimer.']);
    }
}
