<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQueuedAndQueuedAtToHeroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->boolean('queued')->default(false)->after('season');
            $table->dateTime('queued_at')->nullable()->after('queued');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->dropColumn('queued');
            $table->dropColumn('queued_at');
        });
    }
}
