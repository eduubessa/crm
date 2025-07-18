<?php

use App\Http\Controllers\Campaigns\DeleteCampaignController;
use App\Http\Controllers\Campaigns\IndexCampaignController;
use App\Http\Controllers\Campaigns\StoreCampaignController;
use App\Http\Controllers\Campaigns\UpdateCampaignController;
use App\Http\Controllers\Customers\DeleteCustomerController;
use App\Http\Controllers\Customers\IndexCustomerController;
use App\Http\Controllers\Customers\StoreCustomerController;
use App\Http\Controllers\Customers\UpdateCustomerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardController::class)->name('home');
    Route::get('/home', DashboardController::class)->name('dashboard');

    Route::prefix('customers')->group(function () {
        Route::get('/', IndexCustomerController::class)->name('customers.list');
        Route::post('/', StoreCustomerController::class)->name('customers.store');
        Route::put('/{reference}', UpdateCustomerController::class)->name('customers.update');
        Route::delete('/{reference}', DeleteCustomerController::class)->name('customers.delete');
    });

});

Route::prefix('campaigns')->group(function () {
    Route::get('/', IndexCampaignController::class)->name('campaigns.list');
    Route::post('/', StoreCampaignController::class)->name('campaigns.store');
    Route::put('/{reference', UpdateCampaignController::class)->name('campaigns.update');
    Route::delete('/{reference}', DeleteCampaignController::class)->name('campaigns.delete');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
