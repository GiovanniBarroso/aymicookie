<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Página principal y Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas por autenticación
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Rutas accesibles por todos los usuarios autenticados
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'store']);
});

/*
|--------------------------------------------------------------------------
| Rutas exclusivas para Administradores (roles_id = 1)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class)->except(['store']);
});

/*
|--------------------------------------------------------------------------
| Ruta de fallback (para errores 404)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('errors.404');
});
