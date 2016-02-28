<?php

Route::get('testing', function () {
    $api = new \App\Rankings\API\DiabloAPI();

    $lb = new \App\Rankings\Parsers\Leaderboards\LeaderboardParser;

    dd($lb->parse($api->leaderboards('season', 5), 10));
});

Route::group(['middleware' => 'api', 'prefix' => 'api'], function () {
    Route::patch('profiles/{profile}', 'ProfileController@update');
    Route::patch('heroes/{hero}', 'HeroController@update');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('heroes/{hero}', 'HeroController@show');
    Route::get('profiles/{profile}', 'ProfileController@show');
    Route::get('leaderboards/{type?}', 'LeaderboardsController@index');
});