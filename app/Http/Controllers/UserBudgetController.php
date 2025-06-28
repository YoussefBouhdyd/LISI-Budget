<?php

namespace App\Http\Controllers;

use App\Models\BudgetProposal;
use App\Models\LineBudgetProposal;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class UserBudgetController extends Controller
{
    public function loadUserBudget()
    {
        $user = auth()->user();
        $totalSpend = $user->budgetProposals->sum('spend');
        $budgetLinesProposals = $user->budgetProposals;
        $totalValidated = $budgetLinesProposals->where('status',"approved")->sum('proposed_amount');
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

    public function loadProposeLineForm() {
        $user = auth()->user();
        $budgetLinesProposals = $user->budgetProposals;
        $totalValidated = $budgetLinesProposals->where('is_validated',true)->sum('proposed_amount');
        return view('line_proposition')
                ->with('userData',$user)
                ->with('budgetLines',$budgetLinesProposals)
                ->with('totalValidated',$totalValidated);
    }
}
