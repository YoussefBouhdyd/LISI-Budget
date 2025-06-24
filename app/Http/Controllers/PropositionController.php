<?php

namespace App\Http\Controllers;

use App\Models\LineBudgetProposal;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    function loadPendingProposition($status = 'pending')
    {
        $propositions = LineBudgetProposal::where('status', $status)->where("is_validated",'1')->get();
        return view("proposition")->with('propositions', $propositions);
    }

    function confirmProposition(Request $request)
    {
        $id = $request->input('id');

        $proposition = LineBudgetProposal::find($id);
        if ($proposition) {
            $proposition->status = 'approved';
            $proposition->save();

            return response()->json(['message' => 'Proposition confirmée avec succès.']);
        }

        return response()->json(['message' => 'Proposition non trouvée.'], 404);
    }

    function rejectProposition(Request $request)
    {
        $id = $request->input('id');

        $proposition = LineBudgetProposal::find($id);
        if ($proposition) {
            $proposition->status = 'rejected';
            $proposition->save();

            return response()->json(['message' => 'Proposition rejetée avec succès.']);
        }

        return response()->json(['message' => 'Proposition non trouvée.'], 404);
    }
}
