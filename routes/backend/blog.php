<?php

use App\Http\Controllers\Backend\BlogController;
use App\Models\Blog;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.blog'.
Route::group([
    'prefix' => 'blog',
    'as' => 'blog.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [BlogController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Blog Management'), route('admin.blog.index'));
            });
        Route::get('deleted', [BlogController::class, 'deleted'])
            ->name('deleted')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.blog.index')
                    ->push(__('Deleted Blogs'), route('admin.blog.deleted'));
            });

        Route::get('create', [BlogController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.blog.index')
                    ->push(__('Create blog'), route('admin.blog.create'));
            });

        Route::post('/', [BlogController::class, 'store'])->name('store');
        Route::group(['prefix' => '{deletedBlogId}'], function () {
            Route::patch('restore', [BlogController::class, 'restore'])->name('restore');
            Route::delete('permanently-delete', [BlogController::class, 'destroy'])->name('permanently-delete');
        });

        Route::group(['prefix' => '{blog}'], function () {
            Route::get('edit', [BlogController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Blog $blog) {
                    $trail->parent('admin.blog.index', $blog)
                        ->push($blog->name)
                        ->push(__('Edit'), route('admin.blog.edit', $blog));
                });

            Route::patch('/', [BlogController::class, 'update'])->name('update');
            Route::delete('/', [BlogController::class, 'delete'])->name('delete');
        });

    });
});
