<?php
Route::group(
    ['prefix' => 'setting', 'as' => 'setting.', 'middleware' => ['is_admin']],
    function () {
        Route::get('/', '\QCod\AppSettings\Controllers\AppSettingController@index')->name('index');
    }
);
