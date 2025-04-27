<?php

namespace App\Http\Controllers\Mechanic\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController2 extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('mechanic')->hasVerifiedEmail()) {
            return redirect()->intended(route('mechanic.dashboard', absolute: false));
        }

        $request->user('mechanic')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
