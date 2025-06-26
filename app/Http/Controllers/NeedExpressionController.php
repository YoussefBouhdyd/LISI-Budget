<?php

namespace App\Http\Controllers;

use App\Models\Engagement;
use App\Models\LineBudgetProposal;
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

    public function storeNeedExpression(Request $request)
    {   
        try {
            $budgetLine = LineBudgetProposal::findOrFail($request->input('budgetId'));
            $budgetLine->spend = $request->input('finalTotal');
            $budgetLine->save();
            $budgetId =  $request->input('budgetId');
            $needs = $request->input('items');
            $engagement = new Engagement();
            $engagement->line_budget_proposal_id = $budgetId;
            $engagement->status = 'pending';
            $engagement->save();
            foreach ($needs as $need) {
                $engagement->needs()->create([
                    'nature' => $need['name'] ?? null,
                    'description' => $need['description'] ?? null,
                    'quantity' => $need['qty'] ?? null,
                    'estimated_amount' => $need['price'] ?? null,
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Need expression stored successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function loadNeedExpressionAdmin()
    {
        $engagements = Engagement::where('status', 'pending')
            ->get();

        return view('engagements', [
            'engagements' => $engagements,
        ]);
    }
}
