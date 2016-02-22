<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->string('clan_name')->nullable();
            $table->integer('paragon_level')->nullable();
            $table->integer('paragon_level_hardcore')->nullable();
            $table->integer('paragon_level_season')->nullable();
            $table->integer('kills_monsters')->nullable();
            $table->integer('kills_elites')->nullable();
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
        Schema::drop('profile_stats');
    }
}
