<?php

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::patch('profiles/{profile}', 'ProfileController@update');
    Route::patch('heroes/{hero}', 'HeroController@update');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('heroes/{hero}', 'HeroController@show');
    Route::get('profiles/{profile}', 'ProfileController@show');
    Route::get('leaderboards/season/{season}/class/{class}', 'LeaderboardsController@class');
});