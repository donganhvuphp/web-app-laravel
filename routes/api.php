<?php

use App\Http\Controllers\Api\v1\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Admin\CategoryController;
use App\Http\Controllers\Api\v1\Admin\ProductController;
use App\Http\Controllers\Api\v1\Admin\BrandController;
use App\Http\Controllers\Api\v1\Client\ShoppingCartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(
    function () {
        Route::prefix('auth')->group(function () {
            Route::post('/login', [AuthController::class, 'login']);
            Route::post('/register', [AuthController::class, 'register']);
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::post('/refresh', [AuthController::class, 'refresh']);
            Route::get('/user-profile', [AuthController::class, 'userProfile']);
            Route::post('/change-pass', [AuthController::class, 'changePassWord']);
        });
        Route::middleware('auth:api')->group(function () {
            Route::prefix('brands')->group(function () {
                Route::get('/', [BrandController::class, 'index']);
                Route::get('/{id}', [BrandController::class, 'show']);
                Route::post('/create', [BrandController::class, 'store']);
                Route::post('/update/{id}', [BrandController::class, 'update']);
                Route::delete('/{id}', [BrandController::class, 'destroy']);
            });
            Route::prefix('products')->group(function () {
                Route::get('/', [ProductController::class, 'index']);
                Route::get('/{id}', [ProductController::class, 'show']);
                Route::post('/create', [ProductController::class, 'store']);
                Route::post('/update/{id}', [ProductController::class, 'update']);
                Route::delete('/{id}', [ProductController::class, 'destroy']);
            });
            Route::prefix('shopping-cart')->group(function () {
                Route::get('/', [ShoppingCartController::class, 'show']);
                Route::post('/create', [ShoppingCartController::class, 'store']);
                Route::delete('/{id}', [ShoppingCartController::class, 'destroy']);
                Route::post('/update/{id}', [ShoppingCartController::class, 'update']);
            });
            Route::resource('categories', CategoryController::class);
        });

    }
);

Route::fallback(
    function () {
        abort(404, __('message.http.404'));
    }
);

