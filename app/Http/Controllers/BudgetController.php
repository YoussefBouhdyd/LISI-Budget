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

    public function updateLineBudget (Request $request) {
        foreach ($request->all() as $key => $value) {
            if ($key === "_token") continue;
            $lineBudget = LineBudget::find((int) $key);
            $lineBudget->amount = $value;
            $lineBudget->save();
        }
        return redirect('budget');
    }

}
