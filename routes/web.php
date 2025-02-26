<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\CartController;


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






Route::middleware('auth')->group(function () {
    // Ver carrito completo
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // Ver vista previa del carrito (modal)
    Route::get('/cart/preview', [CartController::class, 'getCartPreview'])->name('cart.preview');

    // Agregar un producto al carrito
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

    // Eliminar un producto del carrito
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Vaciar el carrito
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
});

//Ruta para actualizar la cantidad de productos en el carrito
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
