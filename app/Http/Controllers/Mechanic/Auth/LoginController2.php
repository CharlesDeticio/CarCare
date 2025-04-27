<?php

namespace App\Http\Controllers\Mechanic\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController2 extends Controller
{
    
    // Show the mechanic login form
    public function create()
    {
        // If the mechanic is already authenticated, redirect to the dashboard
        if (Auth::guard('mechanic')->check()) {
            return redirect()->route('mechanic.dashboard');
        }

        return view('mechanic.auth.login');
    }

    // Handle mechanic login
    public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('mechanic')->attempt($credentials)) {
        $mechanic = Auth::guard('mechanic')->user();

        // Check verification status
        if (is_null($mechanic->email_verified_at)) {
            Auth::guard('mechanic')->logout();
            return redirect()->route('mechanic.login')
                   ->withErrors(['email' => 'Email not verified. Please complete OTP verification.']);
        }

        if (!$mechanic->verified) {
            Auth::guard('mechanic')->logout();
            return redirect()->route('mechanic.login')
                   ->with('status', 'Account is pending admin approval. You will be notified when approved.');
        }

        $request->session()->regenerate();
        return redirect()->route('mechanic.overview');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
}



    // Logout the mechanic
    public function destroy(Request $request)
    {
        Auth::guard('mechanic')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('mechanic.login');
    }
}