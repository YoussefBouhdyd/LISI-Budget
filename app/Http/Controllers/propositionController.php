<?php

namespace App\Http\Controllers;

use App\Models\LineBudgetProposal;
use Illuminate\Http\Request;

class propositionController extends Controller
{
    function loadPendingProposition()
    {
        $propositions = LineBudgetProposal::where('status', 'pending')->where("is_validated",'1')->get();
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
}
