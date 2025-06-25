<?php

namespace App\Http\Controllers;

use App\Models\BudgetProposal;
use App\Models\LineBudgetProposal;
use App\Models\User;
use Illuminate\Http\Request;

class UserBudgetController extends Controller
{
    public function loadUserBudget(Request $request)
    {
        $user = auth()->user();
        $totalSpend = $user->budgetProposals->sum('spend');
        $budgetLinesProposals = $user->budgetProposals;
        $totalValidated = $budgetLinesProposals->where('is_validated',true)->sum('proposed_amount');
        return view('my_budget')
                ->with('userData',$user)
                ->with('totalSpend',$totalSpend)
                ->with('budgetLines',$budgetLinesProposals)
                ->with('totalValidated',$totalValidated);
    }

    public function proposBudgetLine(Request $request)
    {
        $id = $request->input('id');
        $value = $request->input('value');
        $budgetLine = LineBudgetProposal::find($id);
        if ($budgetLine) {
            $budgetLine->is_validated = true;
            $budgetLine->proposed_amount = $value;
            $budgetLine->save();
            return response()->json(['message' => 'Transmitter deleted successfully']);
        }

        return response()->json(['error' => 'Transmitter not found'], 404);
    }
}
