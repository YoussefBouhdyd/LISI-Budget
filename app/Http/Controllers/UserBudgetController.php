<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserBudgetController extends Controller
{
    public function loadUserBudget(Request $request)
    {
        $user = User::find(0);
        return view('my_budget');
    }
}
