<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Models\Category;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.category'.
Route::group([
    'prefix' => 'category',
    'as' => 'category.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [CategoryController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Category Management'), route('admin.category.index'));
            });
        Route::get('deactivated', [CategoryController::class, 'deactivated'])
            ->name('deactivated')
//            ->middleware('permission:admin.access.user.reactivate')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.category.index')
                    ->push(__('Deactivated Categories'), route('admin.category.deactivated'));
            });
        Route::get('deleted', [CategoryController::class, 'deleted'])
            ->name('deleted')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.category.index')
                    ->push(__('Deleted Categories'), route('admin.category.deleted'));
            });

        Route::get('create', [CategoryController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.category.index')
                    ->push(__('Create category'), route('admin.category.create'));
            });

        Route::post('/', [CategoryController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedCategoryId}'], function () {
            Route::patch('restore', [CategoryController::class, 'restore'])->name('restore');
            Route::delete('permanently-delete', [CategoryController::class, 'destroy'])->name('permanently-delete');
        });


        Route::group(['prefix' => '{category}'], function () {
            Route::get('edit', [CategoryController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Category $category) {
                    $trail->parent('admin.category.index')
                        ->push($category->name)
                        ->push(__('Edit'), route('admin.category.edit', $category));

                });
            Route::patch('mark/{status}', [CategoryController::class, 'mark'])
                ->name('mark')
                ->where(['status' => '[0,1]']);

            Route::patch('/', [CategoryController::class, 'update'])->name('update');
            Route::delete('/', [CategoryController::class, 'delete'])->name('delete');


        });

    });
});
