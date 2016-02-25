<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->integer('battlenet_hero_id')->unsigned();
            $table->string('battle_tag');
            $table->enum('class', ['barbarian', 'crusader', 'demon-hunter', 'monk', 'witch-doctor', 'wizard']);
            $table->boolean('gender');
            $table->boolean('hardcore');
            $table->integer('paragon_level');
            $table->string('name')->default('');
            $table->string('clan_tag')->default('');
            $table->string('clan_name')->default('');
            $table->integer('kills');
            $table->boolean('dead');
            $table->char('region');
            $table->boolean('season');
            $table->timestamps();
            $table->unique(['profile_id', 'battlenet_hero_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('heroes');
    }
}
