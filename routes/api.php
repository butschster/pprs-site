<?php

Route::get('quote/{quote}/cached', 'Api\QuotesController@show')->middleware('ttl:600');

Route::prefix('auth')->namespace('Admin\\')->group(function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});

// admin route
Route::namespace('Api\\')->middleware('auth')->group(function () {
    // Pages
    Route::get('page/{id}', 'PagesController@show')->name('page.show');
    Route::get('pages', 'PagesController@index')->name('pages');
    Route::post('pages/sort', 'PagesController@sort')->name('pages.sort');
    Route::post('page/{id}', 'PagesController@update')->name('page.update');
    Route::post('page', 'PagesController@store')->name('page.store');
    Route::delete('pages/{id}', 'PagesController@delete')->name('pages.delete');

    // Banners
    Route::get('banner/{banner}', 'BannersController@show')->name('banner.show');
    Route::post('banner', 'BannersController@store')->name('banner.store');
    Route::put('banner/{banner}', 'BannersController@update')->name('banner.update');
    Route::delete('banner/{banner}', 'BannersController@delete')->name('banner.delete');

    // Quotes
    Route::get('quotes', 'QuotesController@index')->name('quote.index');
    Route::get('quote/{quote}', 'QuotesController@show')->name('quote.show');
    Route::post('quote/{quote}', 'QuotesController@update')->name('quote.update');
    Route::post('quote', 'QuotesController@store')->name('quote.store');
    Route::delete('quote/{quote}', 'QuotesController@delete')->name('quote.delete');

    // News
    Route::get('news', 'NewsController@index')->name('post.index');
    Route::get('news/{post}', 'NewsController@show')->name('post.show');
    Route::post('news/{post}', 'NewsController@update')->name('post.update');
    Route::post('news', 'NewsController@store')->name('post.store');
    Route::delete('news/{post}', 'NewsController@delete')->name('post.delete');

    // Images
    Route::post('image/upload', 'ImagesController@upload')->name('image.upload');
});

