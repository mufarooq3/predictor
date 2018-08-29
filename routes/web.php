<?php


Route::get('/', 'HomeController@index')->name('home');
Route::post('/predict', 'HomeController@predict')->name('predict');