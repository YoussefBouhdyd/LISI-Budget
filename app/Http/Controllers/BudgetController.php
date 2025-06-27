<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\LineBudget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function loadBudget () {
        $budget = Budget::orderBy('created_at','desc')->first();
        $budgetLines = LineBudget::get();
        return view('budget')
            ->with('budgetLines',$budgetLines)
            ->with("budget",$budget)
            ->with('totalSpend',LineBudget::sum('spend'));
    }

    public function addBudgetLine(Request $request) {
        $budgetLine = new LineBudget();
        $budgetLine->name = $request->input('name');
        $budgetLine->save();

        return redirect()->back()->with('success', 'Budget line added successfully.');
    }

    public function createBudget(Request $request) {
        $budget = new Budget();
        $budget->amount = $request->input('budgetAmount');
        $budget->saison = $request->input('budgetSaison');
        $budget->save();

        return redirect()->back()->with('success', 'Budget created successfully.');
    }

}
