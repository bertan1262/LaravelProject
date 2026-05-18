<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\ShopController;

/* =====================================================
   FRONTEND — Ziyaretçi Sayfaları
   ===================================================== */
Route::get('/',                       [ShopController::class, 'index'])    ->name('shop.index');
Route::get('/urunler',                [ShopController::class, 'products']) ->name('shop.products');
Route::get('/urun/{product}',         [ShopController::class, 'show'])     ->name('shop.show');
Route::get('/kategori/{category}',    [ShopController::class, 'category']) ->name('shop.category');

/* =====================================================
   ADMIN — Giriş (Auth) — Korumasız
   ===================================================== */
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/giris',  [AdminAuthController::class, 'loginForm'])->name('login');
    Route::post('/giris', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/cikis', [AdminAuthController::class, 'logout'])->name('logout');

    /* =====================================================
       ADMIN — Korumalı Rotalar (AdminMiddleware)
       ===================================================== */
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {

        // Dashboard
        Route::get('/',          [AdminDashboardController::class, 'index'])->name('dashboard');

        // Ürün rotaları — /admin/product
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/',                [AdminProductController::class, 'index'])   ->name('index');
            Route::get('/create',          [AdminProductController::class, 'create'])  ->name('create');
            Route::post('/',               [AdminProductController::class, 'store'])   ->name('store');
            Route::get('/{product}',       [AdminProductController::class, 'show'])    ->name('show');
            Route::get('/{product}/edit',  [AdminProductController::class, 'edit'])    ->name('edit');
            Route::put('/{product}',       [AdminProductController::class, 'update'])  ->name('update');
            Route::delete('/{product}',    [AdminProductController::class, 'destroy']) ->name('destroy');
        });

        // Kategori rotaları — /admin/category
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/',               [AdminCategoryController::class, 'index'])   ->name('index');
            Route::get('/create',         [AdminCategoryController::class, 'create'])  ->name('create');
            Route::post('/',              [AdminCategoryController::class, 'store'])   ->name('store');
            Route::get('/{category}/edit',[AdminCategoryController::class, 'edit'])   ->name('edit');
            Route::put('/{category}',     [AdminCategoryController::class, 'update']) ->name('update');
            Route::delete('/{category}',  [AdminCategoryController::class, 'destroy'])->name('destroy');
        });
    });
});
