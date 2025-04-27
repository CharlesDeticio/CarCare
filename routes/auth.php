<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
                    ->name('register');

        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
                    ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                    ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                    ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
                    ->name('password.store');
    });

Route::middleware('auth')->group(function () {


    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'logout'])
                ->name('logout');
});


                // routes/web.php
Route::get('/otp-verify', [RegisteredUserController::class, 'showOTPVerificationForm'])
->name('otp.verify');

Route::post('/otp-verify', [RegisteredUserController::class, 'verifyOTP'])
->name('otp.verify.submit');

Route::post('/resend-otp', [RegisteredUserController::class, 'resendOTP'])
->name('otp.resend');