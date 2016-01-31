<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaderboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->integer('hero_id')->unsigned();
            $table->foreign('hero_id')->references('id')->on('heroes');
            $table->enum('class', ['barbarian', 'crusader', 'demon hunter', 'monk', 'witch doctor', 'wizard']);
            $table->boolean('season');
            $table->integer('period');
            $table->integer('players');
            $table->integer('rank');
            $table->integer('rift_level');
            $table->integer('rift_time');
            $table->boolean('hardcore');
            $table->char('region');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leaderboards');
    }
}
