<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    ProductController,
    UserController,
    CategoryController,
    OrderController,
    CartController,
    AboutController,
    ContactController,
    FavoriteController,
    DiscountController,
    AddressController,
    PayPalController,
    BrandController,
    FacturaController
};

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('dashboard'));

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/shop', [ProductController::class, 'shop'])->name('products.shop');

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN Y PERFIL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::view('/profile/edit', 'profile.edit')->name('profile.edit');
    Route::view('/profile/password', 'profile.password')->name('profile.password');
});

/*
|---------------------------------------------------------------------------
| RUTAS SOLO ADMIN
|---------------------------------------------------------------------------
*/
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', 'verified', RoleMiddleware::class . ':1'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/panel', [AdminController::class, 'indexPanel'])->name('admin.panel');
        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('orders', OrderController::class)->except(['store']);
        Route::resource('discounts', DiscountController::class);
        Route::patch('/discounts/toggle/{id}', [DiscountController::class, 'toggleStatus'])->name('discounts.toggle');
    });


/*
|--------------------------------------------------------------------------
| RUTAS AUTENTICADAS (USUARIO)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Carrito
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/preview', [CartController::class, 'getCartPreview'])->name('cart.preview');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/cart/confirm', [CartController::class, 'confirmPurchase'])->name('cart.confirm');
    Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');

    // Favoritos
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle/{productId}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');

    // Mis pedidos
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/my-orders/{order}', [OrderController::class, 'showUser'])->name('my-orders.show');

    // Direcciones
    Route::resource('addresses', AddressController::class)->except(['show']);

    // Factura
    Route::get('/factura/pdf', [FacturaController::class, 'generarFactura'])->name('factura.pdf');

    // Checkout
    Route::prefix('checkout')->group(function () {
        Route::get('/', [PayPalController::class, 'createPayment'])->name('checkout');
        Route::get('/success', [PayPalController::class, 'successPayment'])->name('checkout.success');
        Route::get('/process-success', [PayPalController::class, 'successPayment'])->name('checkout.process-success');
        Route::get('/cancel', [PayPalController::class, 'cancelPayment'])->name('checkout.cancel');
        Route::get('/review', [PayPalController::class, 'reviewOrder'])->name('checkout.review');
        Route::post('/pay', [PayPalController::class, 'createPayment'])->name('checkout.pay');
        Route::post('/confirm', [PayPalController::class, 'showConfirmation'])->name('checkout.confirm');
    });
});
