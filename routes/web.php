<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{slug}', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::post('/product/{product}/review', [ReviewController::class, 'store'])->name('review.store')->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');

        Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{category}', 'show')->name('show');
            Route::get('/{category}/edit', 'edit')->name('edit');
            Route::put('/{category}', 'update')->name('update');
            Route::delete('/{category}', 'destroy')->name('destroy');
        });

        Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{product}', 'show')->name('show');
            Route::get('/{product}/edit', 'edit')->name('edit');
            Route::put('/{product}', 'update')->name('update');
            Route::delete('/{product}', 'destroy')->name('destroy');
            Route::delete('/image/{productImage}', 'destroyImage')->name('image.destroy');
        });

        Route::prefix('message')->name('message.')->controller(MessageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{message}', 'show')->name('show');
            Route::delete('/{message}', 'destroy')->name('destroy');
        });

        Route::prefix('faq')->name('faq.')->controller(FaqController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{faq}', 'show')->name('show');
            Route::get('/{faq}/edit', 'edit')->name('edit');
            Route::put('/{faq}', 'update')->name('update');
            Route::delete('/{faq}', 'destroy')->name('destroy');
        });

        Route::prefix('review')->name('review.')->controller(AdminReviewController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{review}', 'show')->name('show');
            Route::put('/{review}', 'update')->name('update');
            Route::delete('/{review}', 'destroy')->name('destroy');
        });
    });
});
