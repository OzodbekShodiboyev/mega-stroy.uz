<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// ─── Public ────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/address', fn () => view('address'))->name('address');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/products/{slug}/reviews', [ReviewController::class, 'store'])->name('review.store');
Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ─── Auth ───────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Admin ──────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', Admin\ProductController::class)->names([
        'index'   => 'products.index',
        'create'  => 'products.create',
        'store'   => 'products.store',
        'edit'    => 'products.edit',
        'update'  => 'products.update',
        'destroy' => 'products.destroy',
    ]);

    // Catalog settings
    Route::get('catalog/categories',                  [Admin\CategoryController::class, 'index'])->name('catalog.categories');
    Route::post('catalog/categories',                 [Admin\CategoryController::class, 'store'])->name('catalog.categories.store');
    Route::patch('catalog/categories/{category}',     [Admin\CategoryController::class, 'update'])->name('catalog.categories.update');
    Route::delete('catalog/categories/{category}',    [Admin\CategoryController::class, 'destroy'])->name('catalog.categories.destroy');

    Route::get('catalog/units',                       [Admin\UnitController::class, 'index'])->name('catalog.units');
    Route::post('catalog/units',                      [Admin\UnitController::class, 'store'])->name('catalog.units.store');
    Route::patch('catalog/units/{unit}',              [Admin\UnitController::class, 'update'])->name('catalog.units.update');
    Route::delete('catalog/units/{unit}',             [Admin\UnitController::class, 'destroy'])->name('catalog.units.destroy');

    Route::get('catalog/colors',                      [Admin\ColorController::class, 'index'])->name('catalog.colors');
    Route::post('catalog/colors',                     [Admin\ColorController::class, 'store'])->name('catalog.colors.store');
    Route::patch('catalog/colors/{color}',            [Admin\ColorController::class, 'update'])->name('catalog.colors.update');
    Route::delete('catalog/colors/{color}',           [Admin\ColorController::class, 'destroy'])->name('catalog.colors.destroy');

    Route::get('catalog/textures',                    [Admin\TextureController::class, 'index'])->name('catalog.textures');
    Route::post('catalog/textures',                   [Admin\TextureController::class, 'store'])->name('catalog.textures.store');
    Route::patch('catalog/textures/{texture}',        [Admin\TextureController::class, 'update'])->name('catalog.textures.update');
    Route::delete('catalog/textures/{texture}',       [Admin\TextureController::class, 'destroy'])->name('catalog.textures.destroy');

    Route::get('orders',          [Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}',  [Admin\OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}',[Admin\OrderController::class, 'update'])->name('orders.update');

    Route::get('messages',              [Admin\MessageController::class, 'index'])->name('messages.index');
    Route::delete('messages/{message}', [Admin\MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('users',              [Admin\UserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}',     [Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}',    [Admin\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('settings',  [Admin\SettingsController::class, 'index'])->name('settings');
    Route::put('settings',  [Admin\SettingsController::class, 'update'])->name('settings.update');

    Route::get('reviews',                               [Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::patch('reviews/{review}/approve',            [Admin\ReviewController::class, 'approve'])->name('reviews.approve');
    Route::delete('reviews/{review}',                   [Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::get('works',              [Admin\WorkController::class, 'index'])->name('works.index');
    Route::post('works',             [Admin\WorkController::class, 'store'])->name('works.store');
    Route::delete('works/{work}',    [Admin\WorkController::class, 'destroy'])->name('works.destroy');
});
