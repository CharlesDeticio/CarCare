<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController1;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController1;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController1;
use App\Http\Controllers\Admin\Auth\NewPasswordController1;
use App\Http\Controllers\Admin\Auth\PasswordController1;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController1;
use App\Http\Controllers\Admin\Auth\RegisteredUserController1;
use App\Http\Controllers\Admin\Auth\VerifyEmailController1;
use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminNotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController1::class, 'create'])
                ->name('admin.register');

    Route::post('register', [RegisteredUserController1::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
                ->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController1::class, 'create'])
    //             ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController1::class, 'store'])
    //             ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController1::class, 'create'])
    //             ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController1::class, 'store'])
    //             ->name('password.store');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    // Route::get('verify-email', EmailVerificationPromptController1::class)
    //             ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController1::class)
    //             ->middleware(['signed', 'throttle:6,1'])
    //             ->name('verification.verify');

    // Route::post('email/verification-notification', [EmailVerificationNotificationController1::class, 'store'])
    //             ->middleware('throttle:6,1')
    //             ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController1::class, 'show'])
    //             ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController1::class, 'store']);

    // Route::put('password', [PasswordController1::class, 'update'])->name('password.update');

    Route::post('logout', [LoginController::class, 'destroy'])
                ->name('admin.logout');
});


// Routes for booking and report
Route::get('/admin/adminbooking', function () {
    return view('admin.auth.adminbooking');
})->name('adminbooking');
    
Route::get('/admin/adminreport', [AdminReportController::class, 'index'])->name('adminreport');

// Routes for dashboard and deleting users and mechanics
Route::get('/admin/dashboard', [AdminController::class, 'showUsers'])->name('admin.dashboard');

Route::get('/admin/indexuser', [AdminController::class, 'indexUser'])->name('admin.indexuser');



// Routes to view user and mechanic details
Route::get('/admin/user/view/{id}', [AdminController::class, 'viewUser'])->name('admin.user.view');
Route::get('/admin/mechanic/view/{id}', [AdminController::class, 'viewMechanic'])->name('admin.mechanic.view');

// Separate delete routes for user and mechanic
Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.destroy');
Route::delete('/admin/mechanic/{id}', [AdminController::class, 'destroy'])->name('admin.mechanic.destroy');
// Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/download-pdf', [AdminReportController::class, 'downloadPDF'])->name('admin.reports.pdf');
// });

Route::post('/admin/mechanics/approve/{id}', [AdminController::class, 'approveMechanic'])->name('admin.approveMechanic');
    Route::delete('/admin/mechanics/deny/{id}', [AdminController::class, 'denyMechanic'])->name('admin.denyMechanic');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('forgot-password', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('forgot-password', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('reset-password/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    });
    
    Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
        Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
        Route::get('/notifications/unread-count', [AdminNotificationController::class, 'getUnreadCount'])->name('admin.notifications.unreadCount');
        Route::post('/notifications/mark-read', [AdminNotificationController::class, 'markAllAsRead'])->name('admin.notifications.markAllRead');
        Route::delete('/notifications/{id}', [AdminNotificationController::class, 'destroy'])->name('admin.notifications.destroy');
        Route::get('/admin/notifications/fetch', [AdminNotificationController::class, 'fetch'])->name('admin.notifications.fetch');
    });
