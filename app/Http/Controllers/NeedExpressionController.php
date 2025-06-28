<?php

namespace App\Http\Controllers;

use App\Models\Engagement;
use App\Models\LineBudgetProposal;
use Illuminate\Http\Request;

class NeedExpressionController extends Controller
{
    public function loadNeedExpressionForm()
    {   
        $approvedBudgetLines = auth()->user()
            ->budgetProposals()
            ->where('status', 'approved')
            ->get();

        return view('need_expression', [
            'approvedBudgetLines' => $approvedBudgetLines,
        ]);

    }

    public function trackNeedExpression($status = 'pending')
    {
        $engagements = Engagement::where('status', $status)
            ->whereHas('lineBudgetProposal', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        return view('track_need_expression', [
            'engagements' => $engagements,
        ]);
    }

    public function storeNeedExpression(Request $request)
    {   
        try {
            $budgetLine = LineBudgetProposal::findOrFail($request->input('budgetId'));
            $budgetLine->spend += $request->input('finalTotal');
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

    public function loadNeedExpressionAdmin($status = 'pending')
    {
        $engagements = Engagement::where('status', $status)
            ->get();

        return view('engagements', [
            'engagements' => $engagements,
        ]);
    }

    public function approveNeedExpression(Request $request)
    {
        try {
            $engagement = Engagement::findOrFail($request->input('id'));
            $engagement->status = 'approved';
            $engagement->save();
            return response()->json(['success' => true, 'message' => 'Need expression approved successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function rejectNeedExpression(Request $request)
    {
        try {
            $engagement = Engagement::findOrFail($request->input('id'));
            $budgetLine = $engagement->lineBudgetProposal;
            $budgetLine->spend -= $engagement->needs->sum('estimated_amount');
            $budgetLine->save();
            $engagement->status = 'rejected';
            $engagement->save();
            return response()->json(['success' => true, 'message' => 'Need expression rejected successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
