<?php

Route::get('quote/{quote}', 'Api\QuotesController@show')->name('quote.show')->middleware('ttl:600');

Route::prefix('auth')->namespace('Admin\\')->name('admin.')->group(function () {
    Route::post('login', 'AuthController@authenticate');
    Route::post('register', 'AuthController@authenticate');
    Route::get('logout', 'AuthController@logout');
    Route::get('check', 'AuthController@check');
});

// admin route
Route::group(['prefix' => 'admin', 'middleware' => 'api.auth'], function () {


});

