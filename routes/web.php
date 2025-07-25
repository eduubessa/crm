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
use App\Http\Controllers\Tags\DeleteTagController;
use App\Http\Controllers\Tags\IndexTagController;
use App\Http\Controllers\Tags\StoreTagController;
use App\Http\Controllers\Tags\UpdateTagController;
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

    Route::prefix('campaigns')->group(function () {
        Route::get('/', IndexCampaignController::class)->name('campaigns.list');
        Route::post('/', StoreCampaignController::class)->name('campaigns.store');
        Route::put('/{id}', UpdateCampaignController::class)->name('campaigns.update');
        Route::delete('/{id}', DeleteCampaignController::class)->name('campaigns.delete');
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', IndexTagController::class)->name('tags.list');
        Route::post('/', StoreTagController::class)->name('tags.store');
        Route::delete('/{slug}', DeleteTagController::class)->name('tags.delete');
    });

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
