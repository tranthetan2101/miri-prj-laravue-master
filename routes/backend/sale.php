<?php

use App\Http\Controllers\Backend\SaleController;
use App\Models\Sale;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.Sale'.
Route::group([
    'prefix' => 'sale',
    'as' => 'sale.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [SaleController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Sale Management'), route('admin.sale.index'));
            });

        Route::get('create', [SaleController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.sale.index')
                    ->push(__('Create Sale'), route('admin.sale.create'));
            });

        Route::post('/', [SaleController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedSaleId}'], function () {
            Route::patch('restore', [SaleController::class, 'restore'])->name('restore');
            Route::delete('permanently-delete', [SaleController::class, 'destroy'])->name('permanently-delete');
        });
        Route::get('deleted', [SaleController::class, 'deleted'])
            ->name('deleted')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.sale.index')
                    ->push(__('Deleted Sales'), route('admin.sale.deleted'));
            });


        Route::group(['prefix' => '{sale}'], function () {
            Route::get('edit', [SaleController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Sale $sale) {
                    $trail->parent('admin.sale.index')
                        ->push($sale->name)
                        ->push(__('Edit'), route('admin.sale.edit', $sale));

                });

            Route::patch('/', [SaleController::class, 'update'])->name('update');
            Route::delete('/', [SaleController::class, 'delete'])->name('delete');
        });

    });
});
