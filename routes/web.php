<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;

/* =====================================================
   FRONTEND — Ziyaretçi Sayfaları
   ===================================================== */
Route::get('/',                       [ShopController::class, 'index'])    ->name('shop.index');
Route::get('/urunler',                [ShopController::class, 'products']) ->name('shop.products');
Route::get('/urun/{product}',         [ShopController::class, 'show'])     ->name('shop.show');
Route::get('/kategori/{category}',    [ShopController::class, 'category']) ->name('shop.category');

// Sepet Rotaları
Route::get('/sepet',                 [CartController::class, 'index'])  ->name('shop.cart.index');
Route::post('/sepet/ekle/{product}', [CartController::class, 'add'])    ->name('shop.cart.add');
Route::post('/sepet/guncelle',       [CartController::class, 'update']) ->name('shop.cart.update');
Route::post('/sepet/sil',            [CartController::class, 'remove']) ->name('shop.cart.remove');

// Ödeme Rotaları
Route::get('/odeme',                 [CheckoutController::class, 'index'])   ->name('shop.checkout.index');
Route::post('/odeme',                [CheckoutController::class, 'process']) ->name('shop.checkout.process');
Route::get('/siparis-basarili',      [CheckoutController::class, 'success']) ->name('shop.checkout.success');

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

        // Sipariş Rotaları — /admin/order
        Route::prefix('order')->name('order.')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('index');
            Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
            Route::put('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('update');
        });

        // Ekstra Sayfalar (Kullanıcılar, İstatistikler, Ayarlar)
        Route::get('/users', function () {
            $users = \App\Models\User::all();
            return view('admin.users', compact('users'));
        })->name('users');

        Route::get('/stats', function () {
            $stats = [
                'users' => \App\Models\User::count(),
                'products' => \App\Models\Product::count(),
                'categories' => \App\Models\Category::count()
            ];
            return view('admin.stats', compact('stats'));
        })->name('stats');

        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');
    });
});
