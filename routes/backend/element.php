<?php

use App\Http\Controllers\Backend\ElementController;
use App\Models\Element;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.Element'.
Route::group([
    'prefix' => 'element',
    'as' => 'element.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [ElementController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Quản lý thành phần'), route('admin.element.index'));
            });

        Route::get('create', [ElementController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.element.index')
                    ->push(__('Tạo thành phần'), route('admin.element.create'));
            });

        Route::post('/', [ElementController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedElementId}'], function () {
            Route::delete('permanently-delete', [ElementController::class, 'destroy'])->name('permanently-delete');
        });


        Route::group(['prefix' => '{element}'], function () {
            Route::get('edit', [ElementController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Element $element) {
                    $trail->parent('admin.element.index')
                        ->push($element->name)
                        ->push(__('Sửa'), route('admin.element.edit', $element));

                });

            Route::patch('/', [ElementController::class, 'update'])->name('update');
        });

    });
});
