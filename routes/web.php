<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\BookingReminder;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MechanicReportController;
use App\Http\Controllers\EmergencyBookingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EmergencyBookingNotificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\ServiceRatingController;
use App\Http\Controllers\EmergencyBookingRatingController;
use App\Http\Controllers\BookingController;








Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');





Route::get('/', function () {
    return view('welcome');
});

//Route::get('/visit', function () {
//    return view('visit');
//});


//Route::get('/dashboard', function () {
//    return view('dashboard');
//    
//})->middleware(['auth', 'verified'])->name('dashboard');
// Route::prefix('user')->middleware('auth:user')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::get('/booknow', function () {
    return view('booknow');

})->middleware(['auth', 'verified'])->name('booknow');


Route::get('/booking', function () {
    return view('booking');
})->middleware(['auth', 'verified'])->name('booking');

Route::get('/cart', function () {
    return view('cart');
})->middleware(['auth', 'verified'])->name('cart');


//Route::get('/services', function () {
//    return view('services');
//})->middleware(['auth', 'verified'])->name('services');

Route::get('/usershop', function () {
    return view('usershop');
})->middleware(['auth', 'verified'])->name('usershop');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/dashboard', [UserController::class, 'showMechanic'])
    ->middleware(['auth', 'verified']) // ✅ uses default 'web' guard
    ->name('dashboard');
//User Service
Route::get('/mechanic/view/{id}', [UserController::class, 'viewMechanic'])->name('mechanic.view');

Route::get('/mechanic/{id}/services', [UserController::class, 'viewMechanic'])->name('user.services');

//User Product
Route::get('/mechanic/view/{id}', [UserController::class, 'viewMechanics'])->name('mechanic.view');

Route::get('/mechanic/{id}/product', [UserController::class, 'viewMechanics'])->name('user.product');

//Cart Product
Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');

// Route::post('cart/{cart}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');
Route::post('cart/{cart}/increment', [CartController::class, 'increment'])->name('cart.increment');

Route::post('/cart/{cart}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');

Route::middleware('auth')->group(function () {
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    // Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/cart/total', [CartController::class, 'getCartTotal'])->name('cart.total');

});

Route::get('/product-view/{id}', [ProductController::class, 'shows'])->name('product-view');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
// Route::get('/payments/{id}', [PaymentController::class, 'index'])->name('payments.index');


Route::get('/user/pending', [OrderController::class, 'pendingOrders'])->name('user.pending');
    Route::get('/user/claim', [OrderController::class, 'inTransitOrders'])->name('user.claim');
    Route::get('/user/denied', [OrderController::class, 'deniedOrders'])->name('user.denied');
    Route::get('/user/completed', [OrderController::class, 'completedOrders'])->name('user.completed');
    Route::get('/user/accepted', [OrderController::class, 'acceptedOrders'])->name('user.accepted');

    // Define the route for canceling an order
    Route::post('/user/cancel-order', [UserController::class, 'cancelOrder'])->name('user.cancelOrder');

    Route::get('/get-notifications', [NotificationController::class, 'getNotifications'])->name('user.getNotifications');
Route::post('/notifications/read/all', [NotificationController::class, 'markAllNotificationsAsRead'])->name('user.markAllNotificationsAsRead');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    // Route::post('/mechanic/notifications/orders/read-all', [NotificationController::class, 'markAllNotificationsAsRead'])->name('notifications.readAll');

// User notifications
// Route::middleware('auth')->group(function () {
//     Route::get('/get-notifications', [NotificationController::class, 'getNotifications'])->name('user.getNotifications');
//     Route::post('/notifications/read/all', [NotificationController::class, 'markAllNotificationsAsRead'])->name('user.markAllNotificationsAsRead');
//     Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
//     Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
// });


//     Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('user.getNotifications');
// Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('user.markNotificationRead');
// Route::get('/get-order-notifications', [OrderController::class, 'getOrderNotifications'])->name('user.getOrderNotifications');

    // Route::get('/payment', [OrderController::class, 'paymentPage'])->name('orders.payment');
//     Route::post('/cart/increment/{productId}', [PaymentController::class, 'incrementQuantity'])->name('cart.increment');
// Route::post('/cart/decrement/{productId}', [PaymentController::class, 'decrementQuantity'])->name('cart.decrement');

// Route::middleware(['auth:mechanic'])->prefix('mechanic')->group(function () {
    Route::get('mechanic/reports', [MechanicReportController::class, 'index'])->name('mechanic.reports.index');
    Route::get('mechanic/reports/pdf', [MechanicReportController::class, 'generatePDF'])->name('mechanic.reports.pdf');
    Route::get('/reports/history', [MechanicReportController::class, 'history'])->name('mechanic.reports.history');
    Route::get('/mechanic/reports/view/{id}', [MechanicReportController::class, 'view'])
    ->name('mechanic.reports.view');
// });

Route::post('/emergency-booking', [EmergencyBookingController::class, 'store']);

Route::get('/user-emergency-booking', function () {
    return view('user-emergency-booking');
})->name('user-emergency-booking');

// Mechanic interface
Route::get('/mechanic-emergency-booking', function () {
    return view('mechanic-emergency-booking'); // Ensure this matches your Blade template name
})->name('mechanic-emergency-booking'); // Name the route

    // Get all emergency bookings
    Route::get('/emergency-bookings', [EmergencyBookingController::class, 'index'])->name('emergency-bookings');

    // Assign a mechanic to an emergency booking
    Route::post('/emergency-booking/{id}/assign-mechanic', [EmergencyBookingController::class, 'assignMechanic']);

    // Accept an emergency booking
    Route::post('/emergency-booking/{id}/accept', [EmergencyBookingController::class, 'acceptBooking']);
    Route::post('/emergency-booking', [EmergencyBookingController::class, 'store'])->name('emergency-booking.store');
    Route::get('/user/emergency-bookings/status', [EmergencyBookingController::class, 'userBookings'])
    ->middleware('auth')
    ->name('user.emergency.bookings.status');
    Route::get('/mechanic/emergency-bookings/status', [EmergencyBookingController::class, 'mechanicBookings'])->name('mechanic.emergency.bookings.status');
    Route::middleware(['auth:mechanic'])->group(function() {
        Route::post('/emergency-booking/{id}/complete', [EmergencyBookingController::class, 'completeBooking']);
    });

    // Emergency Booking Notifications
    Route::prefix('emergency-booking')->group(function () {
        Route::post('/create', [EmergencyBookingNotificationController::class, 'createEmergencyBooking'])->name('emergency.booking.create');
    
        Route::post('/{id}/accept', [EmergencyBookingNotificationController::class, 'mechanicAcceptBooking'])->name('emergency.booking.accept');
        Route::post('/{id}/complete', [EmergencyBookingNotificationController::class, 'mechanicCompleteBooking'])->name('emergency.booking.complete');
    
        Route::get('/user/notifications', [EmergencyBookingNotificationController::class, 'userNotifications'])->name('emergency.notifications.user');
        Route::get('/mechanic/notifications', [EmergencyBookingNotificationController::class, 'mechanicNotifications'])->name('emergency.notifications.mechanic');
    
        Route::get('/user/unread-count', [EmergencyBookingNotificationController::class, 'getUserUnreadCount'])->name('emergency.notifications.user.unread');
        Route::get('/mechanic/unread-count', [EmergencyBookingNotificationController::class, 'getMechanicUnreadCount'])->name('emergency.notifications.mechanic.unread');
    
        Route::post('/notification/{id}/read', [EmergencyBookingNotificationController::class, 'markAsRead'])->name('emergency.notifications.markAsRead');
        Route::post('/notification/{id}/delete', [EmergencyBookingNotificationController::class, 'deleteNotification'])->name('emergency.notifications.delete');
    
        Route::post('/notifications/mark-all-read', [EmergencyBookingNotificationController::class, 'markAllAsRead'])->name('emergency.notifications.markAllRead');
    });
    
// USER routes
Route::middleware(['auth:web'])->group(function () {
    Route::get('/user/chat/{receiverId}', [MessageController::class, 'userChat'])->name('user.messages.chat');
    Route::get('/user/chats', [MessageController::class, 'userChatList'])->name('user.messages.chatList');
    Route::post('/user/chat/send', [MessageController::class, 'userSend'])->name('user.messages.send');
});

// MECHANIC routes
Route::middleware(['auth:mechanic'])->group(function () {
    Route::get('/mechanic/chats', [MessageController::class, 'mechanicChatList'])->name('mechanic.messages.chatList');
    Route::get('/mechanic/chat/{receiverId}', [MessageController::class, 'mechanicChat'])->name('mechanic.messages.chat');
    Route::post('/mechanic/chat/send', [MessageController::class, 'mechanicSend'])->name('mechanic.messages.send');
});

// User routes
Route::get('/user/chat-notifications', [MessageController::class, 'userChatNotifications'])->name('user.getChatNotifications');

// Mechanic routes
Route::get('/mechanic/chat-notifications', [MessageController::class, 'mechanicChatNotifications'])->name('mechanic.getChatNotifications');

// ✅ User chat read route
Route::post('/user/chat/mark-read', [MessageController::class, 'userMarkChatAsRead'])->name('user.markChatAsRead');

// ✅ Mechanic chat read route
Route::post('/mechanic/chat/mark-read', [MessageController::class, 'mechanicMarkChatAsRead'])->name('mechanic.markChatAsRead');

Route::post('/mechanic/product/add-inventory/{id}', [ProductController::class, 'addInventory'])->name('mechanic.product.addInventory');

// Public Route
Route::get('/all-products', [ProductController::class, 'allProducts'])->name('products.all');
Route::get('/products/filter', [ProductController::class, 'filterByCategory'])->name('products-filter');

// Custom email verification route (alternative to default one)
Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Mark the email as verified

    return redirect('/dashboard')->with('success', 'Your email has been successfully verified!');
})->middleware(['auth', 'signed'])->name('verification.notice');

// Product rating submission
Route::post('/products/{product}/rate', [ProductRatingController::class, 'store'])->middleware('auth');

// Service rating submission
Route::post('/services/{service}/rate', [ServiceRatingController::class, 'store'])->middleware('auth');

// Emergency booking rating submission
Route::post('/emergency-bookings/{booking}/rate', [EmergencyBookingRatingController::class, 'store'])
    ->name('emergency.rating.store')
    ->middleware('auth');

Route::post('/orders/rate', [OrderController::class, 'storeRating'])->name('user.rate');

// Route::post('/bookings/rate-service', [ServiceRatingController::class, 'store'])->name('service-ratings.store');

Route::get('/services/{service}/ratings', [ServiceRatingController::class, 'showServiceRatings'])->name('services.ratings.index');

Route::post('/service-ratings', [ServiceRatingController::class, 'store'])->name('service-ratings.store');

Route::middleware('auth')->get('/chat-list', [MessageController::class, 'userChatListAPI']);

Route::get('/emergency-bookings/{id}', [EmergencyBookingController::class, 'show'])->name('emergency-bookings.show');

Route::post('/mechanic/orders/{order}/did-not-claim', [OrderController::class, 'didNotClaim'])->name('mechanic.orders.didNotClaim');

Route::get('/user/emergency-bookings/{id}', [EmergencyBookingController::class, 'showUser'])->name('user-emergency-bookings.show');

Route::get('/user/bookings/{booking}/receipt', [BookingController::class, 'downloadReceipt'])
    ->name('user.bookings.receipt');
    
Route::get('/orders/{order}/receipt', [OrderController::class, 'downloadReceipt'])
    ->name('user.orders.receipt')
    ->middleware('auth');
// Route::get('/test-email', function () {
//     $user = \App\Models\User::first();
//     $service = \App\Models\Service::first();
//     $booking = \App\Models\Booking::first();

//     if (!$user || !$service || !$booking) {
//         return 'Missing test data (user, service, or booking).';
//     }

//     Mail::to($user->email)->send(new BookingReminder($user, $service, $booking));

//     return 'Test email triggered to: ' . $user->email;
// });


// Route::get('/test-mechanic-email', function () {
//     $mechanic = \App\Models\Mechanic::first(); // test with the first mechanic
//     $service = \App\Models\Service::first();
//     $booking = \App\Models\Booking::where('mechanic_id', $mechanic->id)->first();

//     Mail::to($mechanic->email)->send(new \App\Mail\MechanicBookingReminder($mechanic, $service, $booking));

//     return 'Mechanic test email sent to ' . $mechanic->email;
// });



require __DIR__ . '/auth.php';

require __DIR__ . '/admin-auth.php';

require __DIR__ . '/mechanic-auth.php';

