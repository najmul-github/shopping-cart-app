<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/carts/{id}/status', [AdminController::class, 'updateCartStatus'])->name('admin.updateCartStatus');

    // product related url    
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});

Route::group(['middleware' => 'auth'], function () {
    // Define a route to fetch user data
    Route::get('/api/user', function () { return Auth::user(); });
    // cart-related routes here
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::put('/edit-cart-item/{id}', [CartController::class, 'editCartItem'])->name('cart.edit');
    
    // Additional routes as needed
    Route::get('/user/dashboard', [ProductController::class, 'index'])->name('user.dashboard');
});


require __DIR__.'/auth.php';
