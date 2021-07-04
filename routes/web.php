<?php

use App\Http\Controllers\LocaleController;

/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

/**
 * Component Routes
 */
Route::group(['as' => 'component.'], function () {
    includeRouteFiles(__DIR__.'/component/');
});

if (config('app.env') === 'local') {
    \DB::listen(
        function ($sql) {
            \Log::debug($sql->sql);
            \Log::debug($sql->bindings);
            \Log::debug($sql->time);
        }
    );
}
