<?php

Route::get('quote/{quote}', 'Api\QuotesController@show')->name('quote.show')->middleware('ttl:600');