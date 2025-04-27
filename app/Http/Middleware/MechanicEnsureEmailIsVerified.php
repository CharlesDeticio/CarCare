<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MechanicEnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if mechanic is logged in and not verified
        $mechanic = $request->user('mechanic');

        if (!$mechanic || !$mechanic->hasVerifiedEmail()) {
            return redirect()->route('mechanic.verification.notice')
                ->with('error', 'You must verify your email to access this page.');
        }

        return $next($request);
    }
}
