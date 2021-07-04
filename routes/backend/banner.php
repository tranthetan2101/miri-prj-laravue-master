<?php

use App\Http\Controllers\Backend\BannerController;
use App\Models\Banner;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.Banner'.
Route::group([
    'prefix' => 'banner',
    'as' => 'banner.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [BannerController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Banner Management'), route('admin.banner.index'));
            });

        Route::get('create', [BannerController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.banner.index')
                    ->push(__('Create Banner'), route('admin.banner.create'));
            });

        Route::post('/', [BannerController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedBannerId}'], function () {
            Route::delete('permanently-delete', [BannerController::class, 'destroy'])->name('permanently-delete');
        });


        Route::group(['prefix' => '{banner}'], function () {
            Route::get('edit', [BannerController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Banner $banner) {
                    $trail->parent('admin.banner.index')
                        ->push($banner->url)
                        ->push(__('Edit'), route('admin.banner.edit', $banner));

                });

            Route::patch('/', [BannerController::class, 'update'])->name('update');
        });

    });
});
