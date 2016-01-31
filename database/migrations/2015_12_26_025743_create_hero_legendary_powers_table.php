<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroLegendaryPowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_legendary_power', function (Blueprint $table) {
            $table->integer('hero_id')->unsigned();
            $table->foreign('hero_id')->references('id')->on('heroes');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hero_legendary_power');
    }
}
