<?php

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::get('home', 'HomeController@data');

    Route::get('heroes/{hero}', 'HeroController@showApi');
    Route::patch('heroes/{hero}', 'HeroController@update');
    Route::get('leaderboards/{type}', 'LeaderboardsController@data');
    Route::get('leaderboards/search', 'LeaderboardsController@search');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('heroes/{hero}', 'HeroController@show');
    Route::get('leaderboards/{type?}', 'LeaderboardsController@index');
});