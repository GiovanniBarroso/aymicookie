<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;



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



// Ruta para la página "Sobre Nosotros"
// Esta ruta muestra la vista about.blade.php a través del AboutController
Route::get('/about', [AboutController::class, 'index'])->name('about');


// Ruta para mostrar la página de contacto
// Cuando un usuario accede a "/contact", se ejecuta el método "index" del ContactController
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Ruta para procesar el formulario de contacto
// Cuando el usuario envía el formulario, se ejecuta el método "send" del ContactController
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['es', 'en'])) {
        Session::put('locale', $locale);
        return redirect()->back();
    }
})->name('change.lang');




