<?php

Route::get('quote/{quote}', 'Api\QuotesController@show')->name('quote.show')->middleware('ttl:600');

Route::prefix('auth')->namespace('Admin\\')->group(function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});

// admin route
Route::namespace('Api\\')->middleware('auth')->group(function () {
    Route::get('page/{id}', 'PagesController@show')->name('page.show');
    Route::post('page/{id}', 'PagesController@update')->name('page.update');
    Route::get('pages', 'PagesController@index')->name('pages');
    Route::post('pages/sort', 'PagesController@sort')->name('pages.sort');
});

