<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnCascadeDeleteToHeroLeaderboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hero_leaderboard', function (Blueprint $table) {
            $table->dropForeign('hero_leaderboard_leaderboard_id_foreign');
            $table->foreign('leaderboard_id')
                ->references('id')->on('leaderboards')
                ->onDelete('cascade')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hero_leaderboard', function (Blueprint $table) {
            $table->dropForeign('hero_leaderboard_leaderboard_id_foreign');
            $table->foreign('leaderboard_id')
                ->references('id')
                ->on('leaderboards')
                ->change();
        });
    }
}
