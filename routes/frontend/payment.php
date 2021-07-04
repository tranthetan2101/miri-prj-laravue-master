<?php

use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use Tabuna\Breadcrumbs\Trail;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */
Route::group(['as' => 'momo.', 'prefix' => 'momo', 'middleware' => []], function () {
    Route::get('complete', [\App\Http\Controllers\Frontend\ShoppingController::class, 'momoComplete'])
        ->name('complete');
    Route::post('ipn', [\App\Http\Controllers\Frontend\ShoppingController::class, 'momoIpn'])
        ->name('ipn');
});

Route::group(['as' => 'atm.', 'prefix' => 'atm', 'middleware' => []], function () {
    Route::get('complete', [\App\Http\Controllers\Frontend\ShoppingController::class, 'atmComplete'])
        ->name('complete');
    Route::post('ipn', [\App\Http\Controllers\Frontend\ShoppingController::class, 'onepayIpn'])
        ->name('ipn');
});

Route::group(['as' => 'cc.', 'prefix' => 'cc', 'middleware' => []], function () {
    Route::get('complete', [\App\Http\Controllers\Frontend\ShoppingController::class, 'ccComplete'])
        ->name('complete');
    Route::post('ipn', [\App\Http\Controllers\Frontend\ShoppingController::class, 'onepayIpn'])
        ->name('ipn');
});
