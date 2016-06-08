<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersSeasonHardcorePeriodIndexOnLeaderboards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leaderboards', function (Blueprint $table) {
            $table->index(['season', 'hardcore', 'period', 'players']);
            $table->index('rift_level');
            $table->index('rift_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaderboards', function (Blueprint $table) {
            $table->dropIndex(['season', 'hardcore', 'period', 'players']);
            $table->dropIndex('rift_level');
            $table->dropIndex('rift_time');
        });
    }
}
