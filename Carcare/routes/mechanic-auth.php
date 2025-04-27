<?php

use App\Http\Controllers\Mechanic\Auth\LoginController2;
use App\Http\Controllers\Mechanic\Auth\ConfirmablePasswordController2;
use App\Http\Controllers\Mechanic\Auth\EmailVerificationNotificationController2;
use App\Http\Controllers\Mechanic\Auth\EmailVerificationPromptController2;
use App\Http\Controllers\Mechanic\Auth\NewPasswordController2;
use App\Http\Controllers\Mechanic\Auth\PasswordController2;
use App\Http\Controllers\Mechanic\Auth\PasswordResetLinkController2;
use App\Http\Controllers\Mechanic\Auth\RegisteredUserController2;
use App\Http\Controllers\Mechanic\Auth\VerifyEmailController2;
use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('mechanic')->middleware('guest:mechanic')->group(function () {
    Route::get('register', [RegisteredUserController2::class, 'create'])
                ->name('mechanic.register');

    Route::post('register', [RegisteredUserController2::class, 'store']);

    Route::get('login', [LoginController2::class, 'create'])
                ->name('mechanic.login');

    Route::post('login', [LoginController2::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController2::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController2::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController2::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController2::class, 'store'])
                ->name('password.store');
});

Route::prefix('mechanic')->middleware('auth:mechanic')->group(function () {

    Route::get('/dashboard', function () {
        return view('mechanic.dashboard');
    })->name('mechanic.dashboard');

    Route::get('verify-email', EmailVerificationPromptController2::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController2::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController2::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController2::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController2::class, 'store']);

    Route::put('password', [PasswordController2::class, 'update'])->name('password.update');

    Route::post('logout', [LoginController2::class, 'destroy'])
                ->name('mechanic.logout');

     
});

Route::get('/mechanic/order', function () {
    return view('mechanic.auth.order');
        
})->name('order');
    
Route::get('/mechanic/report', function () {
        return view('mechanic.auth.report');
        
})->name('report');

Route::get('/admin/dashboard', [AdminController::class, 'showUsers'])->name('admin.dashboard');
Route::delete('/admin/{mechanics}', [AdminController::class, 'delete'])->name('mechanic.destroy');

//for Product Mechanic Service

    Route::get('/mechanic/dashboard', [ServiceController::class, 'shwservice'])->name('mechanic.dashboard');
    Route::get('/mechanic/services/create', [ServiceController::class, 'add'])->name('mechanic.service.add');
    Route::post('/mechanic/services', [ServiceController::class, 'storage'])->name('mechanic.storage');
    Route::get('/mechanic/services/{service}', [ServiceController::class, 'shows'])->name('mechanic.shows');
    Route::delete('/mechanic/services/{service}', [ServiceController::class, 'destroys'])->name('mechanic.destroys');
