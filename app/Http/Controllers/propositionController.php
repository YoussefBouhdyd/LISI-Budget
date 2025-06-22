<?php

namespace App\Http\Controllers;

use App\Models\LineBudgetProposal;

class propositionController extends Controller
{
    function loadPendingProposition()
    {
        $propositions = LineBudgetProposal::where('status', 'pending')->where("is_validated",'1')->get();
        return view("proposition")->with('propositions', $propositions);
    }
}
