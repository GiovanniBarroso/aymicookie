<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Session;


Auth::routes();


Route::get('/session-test', function () {
    Session::put('test', 'working');
    return 'Session set';
});

Route::get('/session-check', function () {
    return Session::get('test', 'Session not found');
});



// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/home', function () {
    return view('auth.dashboard');
})->middleware('auth');

// Agrupar rutas CRUD en un middleware (opcional)
Route::middleware(['web'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
});

// Ruta de fallback (en caso de error 404)
Route::fallback(function () {
    return view('errors.404'); // Asegúrate de tener `resources/views/errors/404.blade.php`
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });


    
    // Acceso solo para administradores (roles_id = 1)
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.products');
    });



    // Acceso solo para usuarios normales (roles_id = 2)
    Route::middleware(['role:2'])->group(function () {
        Route::resource('user/orders', UserController::class);
    });
});

