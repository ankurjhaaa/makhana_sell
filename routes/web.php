<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/items', 'items')->name('items');
    Route::get('/item/{slug}', 'item')->name('item');

    Route::middleware('auth')->group(function () {
        Route::post('/add-to-cart/{productId}', 'addToCart')->name('cart.add');
        Route::post('/update-cart', 'updateCartQuantity')->name('cart.update');
        Route::post('/remove-from-cart', 'removeFromCart')->name('cart.remove');
        Route::get('/cart', 'cart')->name('cart');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/place-order', 'placeOrder')->name('order.place');
        Route::get('/success', 'success')->name('success');
        Route::get('/my-orders', 'myOrders')->name('my.orders');
        Route::get('/order/{id}', 'orderDetail')->name('order.detail');
        Route::post('/product/{id}/review', 'storeReview')->name('product.review');
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/my-account', 'account')->name('account.mobile');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::controller(\App\Http\Controllers\AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');

        // Categories
        Route::get('/categories', 'categories')->name('admin.categories');
        Route::get('/categories/create', 'createCategory')->name('admin.categories.create');
        Route::post('/categories', 'storeCategory')->name('admin.categories.store');
        Route::get('/categories/{id}/edit', 'editCategory')->name('admin.categories.edit');
        Route::post('/categories/{id}', 'updateCategory')->name('admin.categories.update');
        Route::delete('/categories/{id}', 'deleteCategory')->name('admin.categories.delete');

        // Products
        Route::get('/products', 'products')->name('admin.products');
        Route::get('/products/create', 'createProduct')->name('admin.products.create');
        Route::post('/products', 'storeProduct')->name('admin.products.store');
        Route::get('/products/{id}/edit', 'editProduct')->name('admin.products.edit');
        Route::post('/products/{id}', 'updateProduct')->name('admin.products.update');
        Route::delete('/products/{id}', 'deleteProduct')->name('admin.products.delete');

        // Orders
        Route::get('/orders', 'orders')->name('admin.orders');
        Route::post('/orders/{id}/status', 'updateOrderStatus')->name('admin.orders.status');
    });
});