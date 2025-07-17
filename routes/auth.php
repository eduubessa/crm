<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
//    Route::get('auth/sign-up', [RegisteredUserController::class, 'create'])->name('register');
//    Route::post('auth/sign-up', [RegisteredUserController::class, 'store']);
    Route::get('auth/sign-in', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('auth/sign-in', [AuthenticatedSessionController::class, 'store']);

    Route::prefix('account')->group(function () {
        Route::prefix('password')->group(function () {
            Route::get('forgot', [PasswordResetLinkController::class, 'create'])->name('password.request');
            Route::post('forgot', [PasswordResetLinkController::class, 'store'])->name('password.email');
            Route::get('reset/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
            Route::post('reset', [NewPasswordController::class, 'store'])->name('password.store');
        });
    });


});

Route::middleware('auth')->group(function () {
    Route::prefix('account')->group(function () {
        Route::prefix('verify')->group(function () {
            Route::prefix('email')->group(function () {
                Route::get('/', EmailVerificationPromptController::class)->name('verification.notice');
                Route::get('/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
                Route::post('/notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
            });
        });

        Route::prefix('password')->group(function () {
            Route::prefix('confirm')->group(function () {
                Route::get('/', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
                Route::post('/', [ConfirmablePasswordController::class, 'store']);
            });
        });
    });

    Route::post('/auth/sign-out', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
