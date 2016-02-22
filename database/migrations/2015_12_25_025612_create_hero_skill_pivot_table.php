<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroSkillPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_skill', function (Blueprint $table) {
            $table->integer('hero_id')->unsigned();
            $table->foreign('hero_id')->references('id')->on('heroes');
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills');
            $table->integer('rune_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hero_skill');
    }
}
