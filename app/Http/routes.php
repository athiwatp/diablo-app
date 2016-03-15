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
        Route::group(['prefix' => '{mode}/{period}'], function () {
            Route::get('{type}', 'LeaderboardsController@seasonShow');

            Route::get('class/{class}', 'LeaderboardsController@classIndex');
            Route::get('class/{class}/{type}', 'LeaderboardsController@classShow');

            Route::get('team/{players}', 'LeaderboardsController@teamIndex');
            Route::get('team/{players}/{type}', 'LeaderboardsController@teamShow');
        });
    });
});