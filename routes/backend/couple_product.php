<?php

use App\Http\Controllers\Backend\CoupleProductController;
use App\Models\CoupleProduct;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.CoupleProduct'.
Route::group([
    'prefix' => 'couple_product',
    'as' => 'couple_product.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [CoupleProductController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Couple Product Management'), route('admin.couple_product.index'));
            });

        Route::get('create', [CoupleProductController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.couple_product.index')
                    ->push(__('Create Couple Product'), route('admin.couple_product.create'));
            });

        Route::post('/', [CoupleProductController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedCoupleProductId}'], function () {
            Route::delete('permanently-delete', [CoupleProductController::class, 'destroy'])->name('permanently-delete');
        });


        Route::group(['prefix' => '{couple_product}'], function () {
            Route::get('edit', [CoupleProductController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, CoupleProduct $couple_product) {
                    $trail->parent('admin.couple_product.index')
                        ->push($couple_product->product1->name.'-'.$couple_product->product2->name)
                        ->push(__('Edit'), route('admin.couple_product.edit', $couple_product));

                });

            Route::patch('/', [CoupleProductController::class, 'update'])->name('update');
        });

    });
});
