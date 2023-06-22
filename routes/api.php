<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\VariationController;

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



Route::middleware('auth:sanctum')->prefix('v1')->group(function () {

    Route::post('/auth/register', [AuthController::class, 'register'])->withoutMiddleware('auth:sanctum');
    Route::post('/auth/login', [AuthController::class, 'login'])->withoutMiddleware('auth:sanctum');

    Route::apiResource('brands', BrandController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('products', ProductController::class);
    Route::post('products/{product}/variations', [VariationController::class, 'store']);
});
