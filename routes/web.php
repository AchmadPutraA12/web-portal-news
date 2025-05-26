<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.guest.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
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
