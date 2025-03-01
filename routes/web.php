<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PayPalController;


Route::get('/', function () {
    return redirect()->route('dashboard');
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
    Route::resource('products', controller: ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class)->except(['store']);
    Route::get('/panel', [AdminController::class, 'indexPanel'])->name('admin.panel');
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

    // Ruta para confirmar la compra y guardar la dirección
    Route::post('/cart/confirm', [CartController::class, 'confirmPurchase'])->name('cart.confirm');
});

//Ruta para actualizar la cantidad de productos en el carrito
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');



// Ruta para la página "Sobre Nosotros"
// Esta ruta muestra la vista about.blade.php a través del AboutController
Route::get('/about', [AboutController::class, 'index'])->name('about');


// Ruta para mostrar la página de contacto
// Cuando un usuario accede a "/contact", se ejecuta el método "index" del ContactController
Route::view('/contact', 'contact')->name('contact');

// Ruta para procesar el formulario de contacto
// Cuando el usuario envía el formulario, se ejecuta el método "send" del ContactController
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/categories', action: [CategoryController::class, 'index'])->name('categories.index');
Route::get('/brands', [AdminController::class, 'indexBrands'])->name('brands.index');
Route::get('/discounts', [DiscountController::class, 'index'])->name('discounts');



Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle/{productId}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');
});



Route::middleware(['auth', RoleMiddleware::class . ':1'])->group(function () {
    Route::resource('discounts', DiscountController::class);
});

// Ruta para activar o desactivar un descuento
Route::patch('/discounts/toggle/{id}', [DiscountController::class, 'toggleStatus'])->name('discounts.toggle');




// Ruta para mostrar el formulario de creación de direcciones
Route::middleware(['auth'])->group(function () {
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
});


Route::get('/checkout', [PayPalController::class, 'createPayment'])->name('checkout');
Route::get('/checkout/success', [PayPalController::class, 'successPayment'])->name('checkout.success');
Route::get('/checkout/process-success', [PayPalController::class, 'successPayment'])->name('checkout.process-success'); // ✅ Procesa el pago
Route::get('/checkout/cancel', [PayPalController::class, 'cancelPayment'])->name('checkout.cancel');
Route::get('/checkout/review', [CartController::class, 'reviewCheckout'])->name('checkout.review');
Route::post('/checkout/pay', [PayPalController::class, 'createPayment'])->name('checkout.pay');
