<?php

namespace App\Http\Controllers\Auth\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/mechanic/login';

    public function showResetForm(Request $request, $token = null)
    {
        return view('mechanic.auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    protected function broker()
    {
        return Password::broker('mechanics');
    }

    protected function guard()
    {
        return Auth::guard('mechanic');
    }

    // Do NOT log them in after reset
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
    }

    // Redirect to mechanic login page after password reset
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect()->route('mechanic.login')->with('status', trans($response));
    }
}
