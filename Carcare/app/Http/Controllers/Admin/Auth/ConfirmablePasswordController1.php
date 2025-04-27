<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController1 extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('mechanic.auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('mechanic')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('mechanic.auth.password'),
            ]);
        }

        $request->session()->put('mechanic.auth.password_confirmed_at', time());

        return redirect()->intended(route('mechanic.dashboard', absolute: false));
    }
}
