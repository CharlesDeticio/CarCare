<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

//Route::get('/visit', function () {
//    return view('visit');
//});


Route::get('/dashboard', function () {
    return view('dashboard');
    
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/booking', function () {
    return view('booking');
})->middleware(['auth', 'verified'])->name('booking');

Route::get('/cart', function () {
    return view('cart');
})->middleware(['auth', 'verified'])->name('cart');


Route::get('/services', function () {
    return view('services');
})->middleware(['auth', 'verified'])->name('services');

Route::get('/usershop', function () {
    return view('usershop');
})->middleware(['auth', 'verified'])->name('usershop');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





//for Product Mechanic Product

    Route::get('/mechanic/dashboard', [ProductController::class, 'index'])->name('mechanic.dashboard');
    Route::get('/mechanic/create', [ProductController::class, 'create'])->name('mechanic.create');
    Route::post('/mechanic/store', [ProductController::class, 'store'])->name('mechanic.store');
    Route::get('/mechanic/products/{product}', [ProductController::class, 'show'])->name('mechanic.show');
    Route::delete('/mechanic/products/{product}', [ProductController::class, 'destroy'])->name('mechanic.destroy');








require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';

require __DIR__.'/mechanic-auth.php';

