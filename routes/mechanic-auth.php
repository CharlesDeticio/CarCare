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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MechanicProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Middleware\MechanicEnsureEmailIsVerified;
use Illuminate\Support\Facades\Auth;
use App\Models\Mechanic;
use App\Http\Controllers\MechanicReportController;





use Illuminate\Support\Facades\Route;

Route::prefix('mechanic')->middleware('guest:mechanic')->group(function () {
    Route::get('register', [RegisteredUserController2::class, 'create'])
                ->name('mechanic.register');

    Route::post('register', [RegisteredUserController2::class, 'store']);

    Route::get('login', [LoginController2::class, 'create'])
                ->name('mechanic.login');

    Route::post('login', [LoginController2::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController2::class, 'create'])
    //             ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController2::class, 'store'])
    //             ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController2::class, 'create'])
    //             ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController2::class, 'store'])
    //             ->name('password.store');
});

// Route::middleware(['auth'])->group(function () {
    Route::get('/mechanic/profile', [MechanicProfileController::class, 'showProfile'])->name('mechanic.profile');
    Route::get('/mechanic/profile/edit', [MechanicProfileController::class, 'edit'])->name('mechanic.profile.edit');
    Route::post('/mechanic/profile/update', [MechanicProfileController::class, 'updateProfile'])->name('mechanic.profile.update');
// });

Route::prefix('mechanic')->middleware('auth:mechanic')->group(function () {
    Route::get('/productdashboard', function () {
        $products = [];
        if (auth()->check()){
            $products = auth()->user()->products()->latest()->get();

        }
        return view('mechanic.productdashboard', compact('products'));
    })->name('mechanic.productdashboard');

    Route::get('/dashboard', function () {
        $services = [];
        if (auth()->check()){
            $services = auth()->user()->services()->latest()->get();

        }
        return view('mechanic.dashboard', compact('services'));
    })->name('mechanic.dashboard.view');

    //Route::get('/user/services', function() {
    //    $services = [];
    //    if (auth()->check()){
    //        $services = auth()->user()->services()->latest()->get();
//
    //    }
    //    return view('user.services', compact('services'));
    //})->name('user.services');


    // Route::get('verify-email', EmailVerificationPromptController2::class)
    //             ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController2::class)
    //             ->middleware(['signed', 'throttle:6,1'])
    //             ->name('verification.verify');

    // Route::post('email/verification-notification', [EmailVerificationNotificationController2::class, 'store'])
    //             ->middleware('throttle:6,1')
    //             ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController2::class, 'show'])
    //             ->name('mechanic.password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController2::class, 'store']);

    // Route::put('password', [PasswordController2::class, 'update'])->name('mechanic.password.update');

    Route::post('logout', [LoginController2::class, 'destroy'])
                ->name('mechanic.logout');

     
});

Route::get('/mechanic/orders', function () {
    return view('mechanic.orders');
        
})->name('orders');
    
Route::get('/mechanic/report', function () {
        return view('mechanic.auth.report');
        
})->name('report');

Route::get('/admin/dashboard', [AdminController::class, 'showUsers'])->name('admin.dashboard');
// Route::delete('/admin/{mechanics}', [AdminController::class, 'delete'])->name('mechanic.destroy');

//for Product Mechanic Service

    Route::get('/mechanic/dashboard', [ServiceController::class, 'shwservice'])->name('mechanic.dashboard');
    Route::get('/mechanic/services/create', [ServiceController::class, 'add'])->name('mechanic.service.add');
    Route::post('/mechanic/services', [ServiceController::class, 'storage'])->name('mechanic.storage');
    Route::get('/mechanic/services/{service}', [ServiceController::class, 'shows'])->name('mechanic.shows');
    Route::delete('/mechanic/services/{service}', [ServiceController::class, 'destroys'])->name('mechanic.destroys');
    Route::get('/mechanic/service/{service}/edit', [ServiceController::class, 'edit'])->name('mechanic.edit');
Route::put('/mechanic/service/{service}', [ServiceController::class, 'update'])->name('mechanic.service.update');

    //for Product Mechanic Product

    Route::get('/mechanic/productdashboard', [ProductController::class, 'showprod'])->name('mechanic.productdashboard');
    Route::get('/mechanic/products/created', [ProductController::class, 'created'])->name('mechanic.created');
    Route::post('/mechanic/products', [ProductController::class, 'store'])->name('mechanic.store');
    Route::get('/mechanic/products/{product}', [ProductController::class, 'show'])->name('mechanic.show');
    Route::delete('/mechanic/products/{product}', [ProductController::class, 'destroy'])->name('mechanic.destroy');
    Route::get('/mechanic/products/{product}/edit', [ProductController::class, 'edit'])->name('mechanic.product.edit');
    Route::put('/mechanic/products/{product}', [ProductController::class, 'update'])->name('mechanic.update');

    Route::get('/mechanic/order', [OrderController::class, 'show'])->name('mechanic.order');

    //Route::get('/mechanics', [MechanicController::class, 'index'])->name('mechanics.index');
    Route::post('/mechanic/create', [MechanicController::class, 'store'])->name('mechanic.create');
    Route::post('/mechanic/dashboard', [MechanicController::class, 'index'])->name('mechanic.dashboard.submit');
    Route::post('/mechanic/logout', [MechanicController::class, 'logout'])->name('mechanic.logout');



    // Route::get('/mechanic/booking/bookingdashboard', [BookingController::class, 'show'])
    // ->name('mechanic.booking.bookingdashboard')
    // ->middleware('auth:mechanic');
    Route::get('/mechanic/bookings', [BookingController::class, 'show'])->name('mechanic.booking.show'); // List all bookings

    Route::get('/bookings', [BookingController::class, 'index'])->name('user.bookings.index');
    Route::get('/bookings/pending', [BookingController::class, 'pending'])->name('user.bookings.pending');
    Route::get('/bookings/accepted', [BookingController::class, 'accepted'])->name('user.bookings.accepted');
    // Route::post('/bookings/cancelled', [BookingController::class, 'cancelled'])->name('user.bookings.cancelled');
    // Route::get('/user/bookings/cancelled', [BookingController::class, 'cancel'])->name('user.bookings.cancelled');
    Route::get('/user/bookings/cancelled', [BookingController::class, 'cancelledList'])->name('user.bookings.cancelled.list');

    // Cancel action (POST)
    Route::post('/user/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('user.bookings.cancel');

    Route::get('/bookings/completed', [BookingController::class, 'completed'])->name('user.bookings.completed');

    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('user.bookings.show');
    Route::get('/services/{service}/book', [BookingController::class, 'create'])->name('user.bookings.create');
    Route::post('/services/{service}/book', [BookingController::class, 'store'])->name('user.bookings.store');

    Route::get('/mechanic/bookings', [ServiceController::class, 'viewBookings'])->name('mechanic.bookings');
    Route::post('/mechanic/bookings/{booking}/accept', [ServiceController::class, 'acceptBooking'])->name('mechanic.bookings.accept');
    Route::post('/mechanic/bookings/{booking}/decline', [ServiceController::class, 'cancelBooking'])->name('mechanic.bookings.decline');
    Route::post('/mechanic/bookings/{booking}/complete', [ServiceController::class, 'completeBooking'])
    ->name('mechanic.bookings.complete');

    
    Route::get('/mechanic/bookings/{booking}', [ServiceController::class, 'showBooking'])->name('mechanic.bookings.show');

// Overview route protected by mechanic verification middleware

    
// Mechanic Notifications Route
Route::get('/mechanic/notifications', [MechanicController::class, 'mechanicNotifications'])
     ->name('mechanic.notifications');

     Route::get('/mechanic/notifications/unread-count', [MechanicController::class, 'getNotifications'])->name('mechanic.notifications.unreadCount');

    Route::post('/mechanic/notifications/mark-all-read', [MechanicController::class, 'markAllNotificationsAsRead'])->name('mechanic.notifications.markAllRead');

    Route::post('/mechanic/notifications/{id}/mark-read', [MechanicController::class, 'markAsRead'])->name('mechanic.notifications.markRead');

     Route::post('/mechanic/notifications/mark-as-read/{id}', [MechanicController::class, 'markNotificationAsRead'])
    ->name('mechanic.notifications.markAsRead');

// Mechanic notifications
// Route::prefix('mechanic')->middleware('auth:mechanic')->group(function () {
//     Route::get('/notifications', [MechanicController::class, 'mechanicNotifications'])->name('mechanic.notifications');
//     Route::get('/notifications/unread-count', [MechanicController::class, 'getNotifications'])->name('mechanic.notifications.unreadCount');
//     Route::post('/notifications/mark-all-read', [MechanicController::class, 'markAllNotificationsAsRead'])->name('mechanic.notifications.markAllRead');
//     Route::post('/notifications/mark-as-read/{id}', [MechanicController::class, 'markNotificationAsRead'])->name('mechanic.notifications.markAsRead');
// });

    
    

    // Mechanic booking routes
// Mechanic booking routes


// In Transit route for users

// Complete order route for users
// Complete order route for users

// Completed orders routes

Route::middleware('auth:mechanic')->group(function () {
    Route::get('/mechanic/orders', [MechanicController::class, 'orders'])->name('mechanic.orders');
    Route::get('/mechanic/orders/{order}', [MechanicController::class, 'showOrder'])->name('mechanic.orders.show');
    Route::post('/mechanic/orders/{order}/update-status', [MechanicController::class, 'updateOrderStatus'])->name('mechanic.orders.updateStatus');
    // Route::get('/mechanic', [MechanicController::class, 'index'])->name('mechanic.index');

});


Route::middleware('auth')->group(function () {
    // Payment page
    Route::post('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.store');
    Route::get('/payments/{productId}', [PaymentController::class, 'index'])->name('payments.buyNow');

    // Process payment
    Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');


});

Route::get('/service/{service}', [ServiceController::class, 'showy'])->name('user.service-details');

// Route::put('/user/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('user.bookings.cancel');

// Mechanic Notifications Route
Route::get('/mechanic/notifications', [MechanicController::class, 'mechanicNotifications'])
     ->name('mechanic.notifications');

     Route::get('/mechanic/notifications/orders/unread', [MechanicController::class, 'getUnreadOrderNotifications'])->name('mechanic.orders.unread');
     Route::get('/mechanics/map', [MechanicController::class, 'showAllMechanics'])->name('mechanics.map');

     // Routes for authenticated mechanics (verification not required yet)
// Route::prefix('mechanic')->middleware(['auth:mechanic'])->group(function () {

//     // Verification notice page
//     Route::get('email/verify', function () {
//         return view('mechanic.auth.verify-email');
//     })->name('mechanic.verification.notice');

//     // Verification link handler
//     Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//         // Force login the mechanic by ID
//         Auth::guard('mechanic')->loginUsingId($request->route('id'));
    
//         // Fulfill the email verification
//         $request->fulfill();
    
//         // Redirect to mechanic dashboard or overview
//         return redirect()->route('mechanic.overview');
//     })->middleware(['signed'])->name('mechanic.verification.verify');

//     // Resend verification email
//     Route::post('email/verification-notification', function (Request $request) {
//         $request->user('mechanic')->sendEmailVerificationNotification();
//         return back()->with('status', 'Verification link sent!');
//     })->middleware('throttle:6,1')->name('mechanic.verification.send');

// });


Route::get('/mechanic/overview', [MechanicController::class, 'overview'])
    ->middleware(['auth:mechanic', MechanicEnsureEmailIsVerified::class])
    ->name('mechanic.overview');

    Route::prefix('mechanic')->name('mechanic.')->group(function () {
        Route::get('forgot-password', [App\Http\Controllers\Auth\Mechanic\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('forgot-password', [App\Http\Controllers\Auth\Mechanic\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('reset-password/{token}', [App\Http\Controllers\Auth\Mechanic\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password', [App\Http\Controllers\Auth\Mechanic\ResetPasswordController::class, 'reset'])->name('password.update');
    });

    Route::get('/mechanic/ratings', [MechanicController::class, 'viewRatings'])
    ->middleware('auth:mechanic')
    ->name('mechanic.ratings');

    Route::post('/mechanic/bookings/{booking}/did-not-arrive', [ServiceController::class, 'didNotArrive'])->name('mechanic.bookings.didNotArrive');

// ✅ Route to delete a specific mechanic notification
Route::delete('/mechanic/notifications/{id}/delete', [MechanicController::class, 'deleteMechanicNotification'])
    ->name('mechanic.notifications.delete')
    ->middleware('auth:mechanic');

    Route::get('/mechanic/emergency/unread', [MechanicController::class, 'getUnreadEmergencyNotifications'])->name('mechanic.emergency.unread');
Route::post('/mechanic/emergency/mark-read', [MechanicController::class, 'markEmergencyNotificationsAsRead'])->name('mechanic.emergency.markAllRead');

Route::get('/mechanic/bookings/{booking}/receipt', [ServiceController::class, 'downloadReceipt'])
    ->name('mechanic.bookings.receipt')
    ->middleware('auth:mechanic');
    
    Route::get('/mechanic/orders/{order}/receipt', [MechanicController::class, 'downloadReceipt'])
    ->name('mechanic.orders.receipt')
    ->middleware('auth:mechanic');
    
   Route::delete('/mechanic/reports/{report}', [MechanicReportController::class, 'destroy'])
    ->name('mechanic.reports.destroy');
    
    Route::get('/mechanic/verify-otp', [MechanicController::class, 'showOTPVerificationForm'])->name('mechanic.verify.otp');
Route::post('/mechanic/verify-otp', [MechanicController::class, 'verifyOTP'])->name('mechanic.verify.otp.submit');
Route::post('/mechanic/resend-otp', [MechanicController::class, 'resendOTP'])->name('mechanic.otp.resend');