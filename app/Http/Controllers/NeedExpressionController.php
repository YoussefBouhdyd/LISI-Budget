<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NeedExpressionController extends Controller
{
    public function loadNeedExpression()
    {   
        $approvedBudgetLines = auth()->user()
            ->budgetProposals()
            ->where('status', 'approved')
            ->get();

        return view('need_expression', [
            'approvedBudgetLines' => $approvedBudgetLines,
        ]);

    }
}
