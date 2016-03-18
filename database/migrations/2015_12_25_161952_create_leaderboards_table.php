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
            $table->increments('id');
            $table->boolean('season');
            $table->integer('period');
            $table->integer('players');
            $table->integer('rank');
            $table->integer('rift_level');
            $table->integer('rift_time');
            $table->bigInteger('rift_timestamp');
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
