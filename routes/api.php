<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NotificationHandler;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('notification/handler', NotificationHandler::class)->name('notification.handler');

// Promo code validation (requires authentication via web session)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('promo-code/validate', [\App\Http\Controllers\Api\PromoCodeController::class, 'checkCode'])->name('api.promo-code.validate');
});

// Also allow validation via web middleware for Inertia requests
Route::middleware('web')->group(function () {
    Route::post('promo-code/validate', [\App\Http\Controllers\Api\PromoCodeController::class, 'checkCode'])->name('promo-code.validate');
});
