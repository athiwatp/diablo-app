<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Hero;
use App\Profile;
use App\User;
use App\Leaderboard;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Profile::class, function (Faker\Generator $faker) {
   return [
       'battle_tag' => 'zeroskillz#1838',
       'region' => 'us',
   ];
});

$factory->define(Hero::class, function (Faker\Generator $faker) {
    return [
        'battlenet_hero_id' => 1,
        'class' => 'barbarian',
        'gender' => 'm',
        'hardcore' => 0,
        'paragon_level' => 1,
        'name' => 'zeroskillz',
        'clan_tag' => 'DNA',
        'clan_name' => 'DNA',
        'kills' => 1,
        'dead' => 0,
        'region' => 'us',
        'season' => true
    ];
});

$factory->define(Leaderboard::class, function (Faker\Generator $faker) {
   return [
       'class' => 'barbarian',
       'season' => true,
       'period' => 1,
       'players' => 1,
       'rank' => 1,
       'rift_level' => 1,
       'rift_time' => 1,
       'hardcore' => 0,
       'region' => 'us'
   ];
});
