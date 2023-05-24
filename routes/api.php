<?php

use App\Http\Controllers\Api\Auth\Actions\{
    ChangeEmailAddressController,
    ChangePasswordController,
    LoginController,
    RefreshTokenController,
    RegisterUserController,
    ResetPasswordController,
    SendEmailVerificationCodeController,
    SendPasswordResetCodeController,
    VerifyEmailAddressController
};
use App\Http\Controllers\Api\Business\Actions\{
    CreateBusinessController
};
use App\Http\Controllers\Api\Category\Actions\{
    CreateCategoryController
};
use App\Http\Controllers\Api\Product\Actions\{
    CreateProductController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/**
 * Routes for authentication
 */
Route::prefix('auth')->group(function () {
    Route::post('/register', RegisterUserController::class)->name('register');
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/send-email-verification-code', SendEmailVerificationCodeController::class)
        ->middleware(['auth:sanctum', 'refresh.token'])
        ->name('send-email-verification-code');
    Route::post('/verify-email-address', VerifyEmailAddressController::class)
        ->middleware(['auth:sanctum', 'refresh.token'])
        ->name('verify-email-address');
    Route::post('/change-password', ChangePasswordController::class)
        ->middleware(['auth:sanctum', 'refresh.token'])
        ->name('change-password');
    Route::post('/change-email', ChangeEmailAddressController::class)
        ->middleware(['auth:sanctum', 'refresh.token'])
        ->name('change-email');
    Route::post('/send-password-reset-code', SendPasswordResetCodeController::class)
        ->name('send-password-reset-code');
    Route::post('/reset-password', ResetPasswordController::class)
        ->name('reset-password');
    Route::post("/refresh-token", RefreshTokenController::class)
        ->middleware(['auth:sanctum', 'refresh.token'])
        ->name('refresh-token');
});

/**
 * @authenticated route group
 */
Route::middleware(['auth:sanctum', 'refresh.token'])->group(function () {

    Route::prefix('businesses')->group(function () {
        Route::post('/', CreateBusinessController::class)->name('create-business');
    });

    Route::prefix('categories')->group(function () {
        Route::post('/', CreateCategoryController::class)->name('create-category');
    });

    Route::prefix('products')->group(function () {
        Route::post('/', CreateProductController::class)->name('create-product');
    });
});
