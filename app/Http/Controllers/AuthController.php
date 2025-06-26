<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function loadSignIn()
    {
        return view('sign');
    }

    function loginIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'admin') {
            return redirect()->intended('/admin');
            }
            return redirect()->intended('/my-budget');
        }

        return redirect()->back()->withErrors([
            'email' => 'Identifiants invalides'
        ]);
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showChangePasswordForm()
    {
        return view('change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        if ($request->current_password === $request->new_password) {
            return back()->withErrors(['new_password' => 'New password must be different from the current password.']);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        // Optionally log out other sessions
        // Auth::logoutOtherDevices($request->new_password);

        return back()->with('status', 'Password changed successfully!');
    }
}
