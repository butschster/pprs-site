<?php

Route::get('', 'HomerController@show')->name('home');

// News
Route::get('news/{news}', 'NewsController@show')->name('news.show');
Route::get('news', 'NewsController@index')->name('news.index');

// Subscription
Route::get('subscribe', 'SubscribeController@form')->name('subscribe.form');
Route::post('subscribe', 'SubscribeController@subscribe')->name('subscribe');

Route::get('sitemap.xml', 'SitemapController@show')->name('sitemap')->middleware('ttl:600');

Auth::routes();

Route::get('{page}', 'PagesController@show')->name('page.show');

Route::get('/home', 'HomeController@index')->name('home');
