<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_stats', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->integer('hero_id')->unsigned();
            $table->foreign('hero_id')->references('id')->on('heroes');
            $table->integer('life');
            $table->integer('damage');
            $table->integer('toughness');
            $table->integer('healing');
            $table->integer('attack_speed');
            $table->integer('armor');
            $table->integer('strength');
            $table->integer('dexterity');
            $table->integer('vitality');
            $table->integer('intelligence');
            $table->integer('physical_resist');
            $table->integer('fire_resist');
            $table->integer('cold_resist');
            $table->integer('lightning_resist');
            $table->integer('poison_resist');
            $table->integer('arcane_resist');
            $table->integer('crit_damage');
            $table->integer('block_chance');
            $table->integer('block_amount_min');
            $table->integer('block_amount_max');
            $table->integer('damage_increase');
            $table->integer('crit_chance');
            $table->integer('damage_reduction');
            $table->integer('thorns');
            $table->integer('life_steal');
            $table->integer('life_per_kill');
            $table->integer('gold_find');
            $table->integer('magic_find');
            $table->integer('life_on_hit');
            $table->integer('primary_resource');
            $table->integer('secondary_resource');
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
        Schema::drop('hero_stats');
    }
}
