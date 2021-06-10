<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/chart', 'HomeController@chart')->name('chart');

