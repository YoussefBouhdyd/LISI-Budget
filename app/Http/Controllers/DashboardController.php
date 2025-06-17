<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\LineBudget;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function loadSummarize () {
        $budget = Budget::orderBy('created_at','desc')->first();
        $budgetLines = LineBudget::get();
        return view('dashboard')
            ->with('budgetLines',$budgetLines)
            ->with("budget",$budget)
            ->with('totalSpend',LineBudget::sum('spend'));
    }
}
