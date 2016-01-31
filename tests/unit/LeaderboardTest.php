<?php

use App\Profile;
use App\Hero;
use App\Leaderboard;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LeaderboardTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testInsertIntoLeaderboard()
    {
        $profile = factory(Profile::class)->create();
        $hero = factory(Hero::class)->make();
        $leaderboard = factory(Leaderboard::class)->make();

        $profile->heroes()
            ->save($hero);

        $leaderboard->hero_id = $hero->id;

        $profile->leaderboards()
            ->save($leaderboard);

        $this->seeInDatabase('leaderboards', ['id' => 1]);
    }
}
