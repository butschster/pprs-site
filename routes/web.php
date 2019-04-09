<?php

Route::get('', 'HomerController@show')->name('home');
Route::get('news/{news}', 'NewsController@show')->name('news.show');
Route::get('news', 'NewsController@index')->name('news.index');
Route::get('{page}', 'PagesController@show')->name('page.show');
