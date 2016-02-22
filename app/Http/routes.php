<?php

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::get('profiles/{profile}', 'ProfileController@update');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('heroes/{hero}', 'HeroController@show');
    Route::get('profiles/{profile}', 'ProfileController@show');
    Route::get('leaderboards/{type?}', 'LeaderboardsController@index');
});