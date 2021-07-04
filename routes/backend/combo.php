<?php

use App\Http\Controllers\Backend\ComboController;
use App\Models\Combo;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.combo'.
Route::group([
    'prefix' => 'combo',
    'as' => 'combo.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [ComboController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Combo Management'), route('admin.combo.index'));
            });
        Route::get('deleted', [ComboController::class, 'deleted'])
            ->name('deleted')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.combo.index')
                    ->push(__('Deleted Combos'), route('admin.combo.deleted'));
            });

        Route::get('create', [ComboController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.combo.index')
                    ->push(__('Create combo'), route('admin.combo.create'));
            });

        Route::post('/', [ComboController::class, 'store'])->name('store');

        Route::group(['prefix' => '{combo}'], function () {
            Route::get('edit', [ComboController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Combo $combo) {
                    $trail->parent('admin.combo.index', $combo)
                        ->push($combo->name)
                        ->push(__('Edit'), route('admin.combo.edit', $combo));
                });

            Route::patch('/', [ComboController::class, 'update'])->name('update');
            Route::delete('/', [ComboController::class, 'delete'])->name('delete');
        });

    });
});
