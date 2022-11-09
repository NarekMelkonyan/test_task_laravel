<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\Profile\CheckoutController;
use App\Http\Controllers\Api\Profile\OrderController;
use App\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::resource('books', BookController::class);
Route::post('search', [SearchController::class, 'search']);

Route::middleware('auth:api')->group(function () {
    Route::prefix('book')->group(function () {
        Route::post('checkout/{book_id}', [CheckoutController::class, 'checkout']);
    });

    Route::prefix('profile')->group(function () {
        Route::resource('orders', OrderController::class);
    });

});
