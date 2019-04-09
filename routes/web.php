<?php

Route::get('', 'HomerController@show')->name('home');
Route::get('{page}', 'PagesController@show')->name('page.show');
