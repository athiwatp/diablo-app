<?php

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::patch('profiles/{profile}', 'ProfileController@update');
    Route::patch('heroes/{hero}', 'HeroController@update');

    Route::get('leaderboards/season/{season}/class/{class}/softcore', 'LeaderboardsController@dataClassSeasonSoftcore');
    Route::get('leaderboards/season/{season}/class/{class}/hardcore', 'LeaderboardsController@dataClassSeasonHardcore');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('heroes/{hero}', 'HeroController@show');
    Route::get('profiles/{profile}', 'ProfileController@show');

    Route::group(['prefix' => 'leaderboards'], function () {
        Route::get('/', 'LeaderboardsController@index');
        Route::group(['prefix' => '{mode}/{period}'], function () {
            Route::get('class/{class}', 'LeaderboardsController@classIndex');
            Route::get('class/{class}/{type}', 'LeaderboardsController@classShow');

            Route::get('team/{players}', 'LeaderboardsController@teamIndex');
            Route::get('team/{players}/{type}', 'LeaderboardsController@teamShow');
        });
    });
});