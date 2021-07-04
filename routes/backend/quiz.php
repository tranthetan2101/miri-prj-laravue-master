<?php

use App\Http\Controllers\Backend\QuizController;
use App\Models\Quiz;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.Quiz'.
Route::group([
    'prefix' => 'quiz',
    'as' => 'quiz.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [QuizController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Quản lý câu hỏi tư vấn'), route('admin.quiz.index'));
            });



        Route::group(['prefix' => '{deletedQuizId}'], function () {
            Route::delete('permanently-delete', [QuizController::class, 'destroy'])->name('permanently-delete');
        });


        Route::group(['prefix' => '{quiz}'], function () {
            Route::get('/', [QuizController::class, 'show'])
                ->name('show')
                ->breadcrumbs(function (Trail $trail, Quiz $quiz) {
                    $trail->parent('admin.quiz.index')
                        ->push($quiz->name, route('admin.quiz.show', $quiz));
                });
        });

    });
});
