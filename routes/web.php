<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('add-to-cart/{id}', [FrontController::class, 'addToCart'])->name('add.to.cart');
Route::get('cart', [FrontController::class, 'cart'])->name('cart');
Route::delete('remove-from-cart', [FrontController::class, 'removeCart'])->name('remove.from.cart');
Route::post('checkout', [FrontController::class, 'checkout'])->name('checkout');
Route::get('order-success/{id}', [FrontController::class, 'success'])->name('order.success');
Route::get('/track-order', [FrontController::class, 'trackOrder'])->name('track.order');

//