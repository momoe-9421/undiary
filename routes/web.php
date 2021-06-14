<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/', 'HomeController@write')->name('write');
Route::get('/chart', 'HomeController@chart')->name('chart');

