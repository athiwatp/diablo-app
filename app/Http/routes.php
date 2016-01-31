<?php

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::get('home', 'HomeController@data');

    Route::get('heroes/{hero}', 'HeroController@showApi');
    Route::patch('heroes/{hero}', 'HeroController@update');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('heroes/{hero}', 'HeroController@show');
});