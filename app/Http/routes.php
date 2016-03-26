<?php

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::patch('profiles/{profile}', 'ProfileController@update');
    Route::get('profiles/search', 'ProfileController@search');
    Route::patch('heroes/{hero}', 'HeroController@update');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('heroes', 'HeroController@index');
    Route::get('heroes/{hero}', 'HeroController@show');
    Route::get('profiles', 'ProfileController@index');
    Route::get('profiles/{profile}', 'ProfileController@show');

    Route::group(['prefix' => 'leaderboards'], function () {
        Route::get('/', 'LeaderboardsController@index');
        Route::get('{leaderboard}/show', 'LeaderboardsController@show');
        Route::get('filter', 'LeaderboardsController@filter');
    });
});