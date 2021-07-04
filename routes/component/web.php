<?php

Route::group(['prefix' => 'component', 'as' => 'Component.', 'middleware' => !App::environment('local') ? ['ajax'] : []], function () {
    Route::get('/banner', 'Component\ComponentController@getBanner')->name('componentBanner');

    Route::get('/favoriteProduct', 'Component\ComponentController@getFavoriteProduct')->name('componentFavoriteProduct');

    Route::get('/listCategory', 'Component\ComponentController@getListCategory')->name('componentListCategory');

    Route::get('/listCoupleProduct', 'Component\ComponentController@getlistCoupleProduct')->name('componentListCoupleProduct');

    Route::get('/listNewsShare', 'Component\ComponentController@getListBlog')->name('componentListBlog');

    Route::get('/newsStory', 'Component\ComponentController@getNewsStory')->name('componentNewsStory');

    Route::post('/receiveInfo', 'Component\ComponentController@postReceiveInfo')->name('componentReceiveInfo');

    Route::get('/getCartQuantity', 'Component\ComponentController@getCartQuantity')->name('getCartQuantity');

    Route::get('/locations', 'Component\ComponentController@ajaxLocations')->name('locations');
    
    Route::get('/contact', 'Component\ComponentController@ajaxContact')->name('contact');
});
