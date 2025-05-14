<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FrontController::class, 'index'])->name('front.index');


// route midtrans, mengirimkan webhook notifikasi, lalu dikirimkan ke method payment..
Route::match(['get', 'post'],'/booking/payment/midtrans/notification',
[FrontController::class, 'paymentMidtransNotification'])
->name('front.paymentMidtransNotification');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
