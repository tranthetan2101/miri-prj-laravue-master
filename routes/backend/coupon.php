<?php

use App\Http\Controllers\Backend\CouponController;
use App\Models\Coupon;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.Coupon'.
Route::group([
    'prefix' => 'coupon',
    'as' => 'coupon.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [CouponController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Coupon Management'), route('admin.coupon.index'));
            });

        Route::get('create', [CouponController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.coupon.index')
                    ->push(__('Create Coupon'), route('admin.coupon.create'));
            });

        Route::post('/', [CouponController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedCouponId}'], function () {
            Route::delete('permanently-delete', [CouponController::class, 'destroy'])->name('permanently-delete');
        });


        Route::group(['prefix' => '{coupon}'], function () {
            Route::get('edit', [CouponController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Coupon $coupon) {
                    $trail->parent('admin.coupon.index')
                        ->push($coupon->code)
                        ->push(__('Edit'), route('admin.coupon.edit', $coupon));

                });

            Route::patch('/', [CouponController::class, 'update'])->name('update');
        });

    });
});
