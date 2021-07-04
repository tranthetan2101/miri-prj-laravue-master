<?php

use App\Http\Controllers\Backend\QuizController;
use App\Models\Quiz;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.Quiz'.
Route::group([
    'prefix' => 'receive_info',
    'as' => 'receive_info.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [\App\Http\Controllers\Backend\ReceiveInfoController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Quản lý danh sách email subscribers'), route('admin.receive_info.index'));
            });
        Route::get('export', '\App\Http\Controllers\Backend\ReceiveInfoController@export')->name('export');

    });
});
