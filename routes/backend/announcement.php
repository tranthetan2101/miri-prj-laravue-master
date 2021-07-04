<?php

use App\Http\Controllers\Backend\AnnouncementController;
use App\Models\Announcement;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.Announcement'.
Route::group([
    'prefix' => 'announcement',
    'as' => 'announcement.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [AnnouncementController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Announcement Management'), route('admin.announcement.index'));
            });

        Route::get('create', [AnnouncementController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.announcement.index')
                    ->push(__('Create Announcement'), route('admin.announcement.create'));
            });

        Route::post('/', [AnnouncementController::class, 'store'])->name('store');


        Route::get('deactivated', [AnnouncementController::class, 'deactivated'])
            ->name('deactivated')
//            ->middleware('permission:admin.access.user.reactivate')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.announcement.index')
                    ->push(__('Deactivated Announcements'), route('admin.announcement.deactivated'));
            });

        Route::group(['prefix' => '{announcement}'], function () {
            Route::get('edit', [AnnouncementController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Announcement $announcement) {
                    $trail->parent('admin.announcement.index')
                        ->push($announcement->message)
                        ->push(__('Edit'), route('admin.announcement.edit', $announcement));

                });
            Route::patch('mark/{status}', [AnnouncementController::class, 'mark'])
                ->name('mark')
                ->where(['status' => '[0,1]']);
            Route::patch('/', [AnnouncementController::class, 'update'])->name('update');
            Route::delete('/', [AnnouncementController::class, 'delete'])->name('delete');
        });

    });
});
