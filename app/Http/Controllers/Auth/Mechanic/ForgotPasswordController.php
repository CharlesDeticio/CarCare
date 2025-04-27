<?php

namespace App\Http\Controllers\Auth\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('mechanic.auth.passwords.email'); // make this view
    }

    protected function broker()
    {
        return Password::broker('mechanics');
    }
}

