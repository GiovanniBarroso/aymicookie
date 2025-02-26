<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware(['auth', 'verified']);


//RUTA AUTENTICACION EN DOS PASOS
// Route::get('/two-factor-challenge', function () {
//     return view('auth.two-factor-challenge');
// })->name('auth.two-factor-challenge')->middleware(['auth', 'verified']);


Route::view('profile/edit', 'profile.edit')->name('profile.edit')->middleware(['auth', 'verified']);
Route::view('profile/password', 'profile.password')->name('profile.password')->middleware(['auth', 'verified']);




// Rutas accesibles solo por administradores (role_id = 1)
Route::middleware(['auth', RoleMiddleware::class . ':1'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class)->except(['store']);
});



// Ruta para que los usuarios normales solo puedan ver productos
Route::get('/shop', [ProductController::class, 'shop'])->name('products.shop');

// Ruta para que los usuarios puedan ver el Carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
