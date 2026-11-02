<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest Admin Auth Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Dashboard & Analytics
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
        Route::get('/analytics/export', [AnalyticsController::class, 'exportCsv'])->name('analytics.export');

        // Categories CRUD
        Route::resource('categories', CategoryController::class);
        Route::post('categories/{id}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle');

        // Products CRUD
        Route::resource('products', ProductController::class);
        Route::post('products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle');
        Route::post('products/{id}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.featured');
        Route::delete('product-images/{id}', [ProductController::class, 'deleteImage'])->name('product-images.delete');

        // Orders Management
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::get('orders/{id}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
        Route::post('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Payments Management
        Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
        Route::post('payments/{id}/status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');

        // Coupons CRUD
        Route::resource('coupons', CouponController::class);
        Route::post('coupons/{id}/toggle-status', [CouponController::class, 'toggleStatus'])->name('coupons.toggle');

        // Users Management
        Route::resource('users', UserController::class);
        Route::post('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle');

        // Banners CRUD
        Route::resource('banners', BannerController::class);
        Route::post('banners/{id}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banners.toggle');

        // Reviews Management
        Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('reviews/{id}/status', [ReviewController::class, 'updateStatus'])->name('reviews.status');
        Route::delete('reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

        // Contact Messages
        Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{id}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::post('messages/{id}/status', [ContactMessageController::class, 'updateStatus'])->name('messages.status');
        Route::delete('messages/{id}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

        // Settings Management
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
