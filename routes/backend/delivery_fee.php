<?php

use App\Http\Controllers\Backend\DeliveryFeeController;
use App\Models\DeliveryFee;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.DeliveryFee'.
Route::group([
    'prefix' => 'delivery_fee',
    'as' => 'delivery_fee.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [DeliveryFeeController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Delivery Fee Management'), route('admin.delivery_fee.index'));
            });
        Route::get('ajax', [DeliveryFeeController::class, 'ajaxLocations'])
            ->name('ajax')
            ->middleware('ajax');
        Route::get('create', [DeliveryFeeController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.delivery_fee.index')
                    ->push(__('Create DeliveryFee'), route('admin.delivery_fee.create'));
            });

        Route::post('/', [DeliveryFeeController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedDeliveryFeeId}'], function () {
            Route::delete('permanently-delete', [DeliveryFeeController::class, 'destroy'])->name('permanently-delete');
        });


        Route::group(['prefix' => '{delivery_fee}'], function () {
            Route::get('edit', [DeliveryFeeController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, DeliveryFee $delivery_fee) {
                    $trail->parent('admin.delivery_fee.index')
                        ->push($delivery_fee->city->name.'-'.$delivery_fee->district->name.'-'.$delivery_fee->ward->name)
                        ->push(__('Edit'), route('admin.delivery_fee.edit', $delivery_fee));

                });

            Route::patch('/', [DeliveryFeeController::class, 'update'])->name('update');
        });

    });
});
