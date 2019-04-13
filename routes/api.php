<?php

Route::get('quote/{quote}', 'Api\QuotesController@show')->name('quote.show')->middleware('ttl:600');

Route::prefix('auth')->namespace('Admin\\')->group(function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});

// admin route
Route::group(['prefix' => 'admin', 'middleware' => 'api.auth'], function () {


});

