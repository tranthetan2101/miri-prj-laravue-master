<?php

use App\Http\Controllers\Backend\OrderController;
use App\Models\Order;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.order'.
Route::group([
    'prefix' => 'order',
    'as' => 'order.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [OrderController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Order Management'), route('admin.order.index'));
            });
        Route::get('pending', [OrderController::class, 'pending'])
            ->name('pending')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.order.index')
                    ->push(__('Pending Orders'), route('admin.order.pending'));
            });
        Route::get('paid', [OrderController::class, 'paid'])
            ->name('paid')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.order.index')
                    ->push(__('Paid Orders'), route('admin.order.paid'));
            });
        Route::get('shipping', [OrderController::class, 'shipping'])
            ->name('shipping')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.order.index')
                    ->push(__('Shipping Orders'), route('admin.order.shipping'));
            });
        Route::get('completed', [OrderController::class, 'completed'])
            ->name('completed')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.order.index')
                    ->push(__('Completed Orders'), route('admin.order.completed'));
            });
        Route::get('deleted', [OrderController::class, 'deleted'])
            ->name('deleted')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.order.index')
                    ->push(__('Deleted Orders'), route('admin.order.deleted'));
            });

        Route::post('/', [OrderController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedOrderId}'], function () {
            Route::patch('restore', [OrderController::class, 'restore'])->name('restore');
        });


        Route::group(['prefix' => '{order}'], function () {
            Route::get('/', [OrderController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, Order $order) {
                    $trail->parent('admin.order.index')
                        ->push($order->order_key, route('admin.order.show', $order));
                });
            Route::get('edit', [OrderController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Order $order) {
                    $trail->parent('admin.order.index')
                        ->push($order->order_key)
                        ->push(__('Edit'), route('admin.order.edit', $order));
                });
            Route::patch('mark/{status}', [OrderController::class, 'mark'])
                ->name('mark')
                ->where(['status' => '[0,1,2,3]']);

            Route::patch('/', [OrderController::class, 'update'])->name('update');
            Route::delete('/', [OrderController::class, 'delete'])->name('delete');
        });

    });
});
