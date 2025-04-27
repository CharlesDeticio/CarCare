<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class MechanicVerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $mechanic = Mechanic::findOrFail($id);

        // Check hash (security)
        if (! hash_equals((string) $hash, sha1($mechanic->getEmailForVerification()))) {
            return redirect()->route('mechanic.login')->with('error', 'Invalid verification link');
        }

        // Already verified
        if ($mechanic->hasVerifiedEmail()) {
            return redirect()->route('mechanic.dashboard')->with('message', 'Email already verified');
        }

        // Mark as verified
        if ($mechanic->markEmailAsVerified()) {
            event(new Verified($mechanic));
        }

        return redirect()->route('mechanic.dashboard')->with('message', 'Email verified successfully!');
    }

    public function notice()
    {
        return view('mechanic.verify-email');
    }

    public function send(Request $request)
    {
        if ($request->user('mechanic')->hasVerifiedEmail()) {
            return redirect()->route('mechanic.dashboard');
        }

        $request->user('mechanic')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}

