<?php

use App\Http\Controllers\Backend\ProductController;
use App\Models\Product;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.product'.
Route::group([
    'prefix' => 'product',
    'as' => 'product.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [ProductController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Product Management'), route('admin.product.index'));
            });
        Route::get('deleted', [ProductController::class, 'deleted'])
            ->name('deleted')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.product.index')
                    ->push(__('Deleted Products'), route('admin.product.deleted'));
            });
        Route::get('ajax', [ProductController::class, 'ajaxProducts'])
            ->name('ajax')
            ->middleware('ajax');

        Route::get('create', [ProductController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.product.index')
                    ->push(__('Create product'), route('admin.product.create'));
            });

        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::group(['prefix' => '{deletedProductId}'], function () {
            Route::patch('restore', [ProductController::class, 'restore'])->name('restore');
            Route::delete('permanently-delete', [ProductController::class, 'destroy'])->name('permanently-delete');
        });

        Route::group(['prefix' => '{product}'], function () {
            Route::get('edit', [ProductController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Product $product) {
                    $trail->parent('admin.product.index', $product)
                        ->push($product->name)
                        ->push(__('Edit'), route('admin.product.edit', $product));
                });

            Route::patch('/', [ProductController::class, 'update'])->name('update');
            Route::delete('/', [ProductController::class, 'delete'])->name('delete');
        });

    });
});
