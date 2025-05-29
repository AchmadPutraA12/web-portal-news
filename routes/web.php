<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Guest\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('category/{id}', [GuestController::class, 'category'])->name('category');
Route::get('article/{id}', [GuestController::class, 'show'])->name('article.detail');

Route::get('/login', [AuthenticatedSessionController::class, 'index'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
    
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
            Route::put('/{id}', [UserController::class, 'update'])->name('update');
        });

        Route::prefix('category-article')->name('category-article.')->group(function () {
            Route::get('/', [CategoryArticleController::class, 'index'])->name('index');
            Route::post('/store', [CategoryArticleController::class, 'store'])->name('store');
            Route::delete('/{id}', [CategoryArticleController::class, 'destroy'])->name('destroy');
            Route::put('/{id}', [CategoryArticleController::class, 'update'])->name('update');
        });

        Route::prefix('article')->name('article.')->group(function () {
            Route::get('/', [ArticleController::class, 'index'])->name('index');
            Route::post('/store', [ArticleController::class, 'store'])->name('store');
            Route::delete('/{id}', [ArticleController::class, 'destroy'])->name('destroy');
            Route::put('/{id}', [ArticleController::class, 'update'])->name('update');
        });

        Route::prefix('verifikasi-article')->name('verifikasi-article.')->group(function () {
            Route::get('/', [ArticleController::class, 'index2'])->name('index');
            Route::put('/{id}', [ArticleController::class, 'update2'])->name('update');
        });
    });
});
