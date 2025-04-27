<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect admins after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/login'; // or '/admin/dashboard' if you prefer

    /**
     * Show the reset password form.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Get the broker to be used during password reset.
     */
    protected function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during password reset.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Customize reset logic (Optional: Disable auto-login after password reset)
     */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Optionally skip auto-login
        // $this->guard()->login($user); // <-- comment this if you don't want auto-login
    }

    /**
     * Customize the response after resetting the password.
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect()->route('admin.login')->with('status', trans($response));
    }
}
