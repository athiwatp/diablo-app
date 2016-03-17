<?php

namespace App\Rankings\Parsers\Leaderboards;

use App\Leaderboard;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class LeaderboardParser
{
    /**
     * Saved Rank for Teams
     *
     * @var
     */
    private static $rank_saved;

    /**
     * Query information from Battlenet
     *
     * @var
     */
    public $self;

    /**
     * Parsed leaderboard
     *
     * @var
     */
    public $leaderboard = [];

    public function __construct()
    {
        $this->self = new stdClass;
    }

    /**
     * Parse the rankings
     *
     * @param array $data
     * @param int|null $limit
     * @return array
     */
    public function parse(array $data, int $limit = null) : array
    {
        foreach ($data as $array) {
            $this->getRankings($array, $limit);
        }

        return $this->leaderboard;
    }

    /**
     * Parse the rankings from the response
     *
     * @param array $leaderboard
     * @param int $limit
     */
    public function getRankings(stdClass $leaderboard, int $limit)
    {
        $this->getSelf($leaderboard);

        $i = 0;
        foreach ($leaderboard->row as $player_data) {
            if (count($player_data->player) == 1) {
                $this->getPlayerData(
                    $player_data->player[0],
                    $this->getLadderData($player_data)
                );
            } else {
                foreach ($player_data->player as $player) {
                    if (count($player_data->data) != 5) {
                        continue;
                    }

                    $this->getPlayerData(
                        $player,
                        $this->getLadderData($player_data)
                    );
                }
            }

            $i++;

            if ($i === $limit) {
                break;
            }
        }
    }

    /**
     * Get the self attributes of the response
     *
     * @param stdClass $leaderboard
     * @return mixed
     */
    public function getSelf(stdClass $leaderboard)
    {
        $this->self->hardcore = $leaderboard->hardcore ?? false;
        $this->self->greater_rift = $leaderboard->greater_rift ?? false;

        if (isset($leaderboard->season)) {
            $this->self->season = true;
            $this->self->period = $leaderboard->season;
        } else {
            $this->self->season = false;
            $this->self->period = $leaderboard->era;
        }

        $this->self->players = isset($leaderboard->greater_rift_solo_class)
            ? 1
            : $leaderboard->greater_rift_team_size;

        $explode = explode('/', $leaderboard->_links->self->href);
        $this->self->region = strtoupper(substr($explode[2], 0, 2));
    }

    /**
     * Retrieve player data from response
     *
     * @param $player
     * @param $ladder_data
     */
    public function getPlayerData(stdClass $player, stdClass $ladder_data)
    {
        $profile = new stdClass;

        foreach ($player->data as $data) {
            list($attr1, $attr2) = array_keys((array)($data));

            $key = snake_case($data->$attr1);

            if (substr($key, 0, 5) == 'hero_') {
                $key = $key !== 'hero_id'
                    ? str_replace('hero_', '', $key)
                    : 'battlenet_hero_id';
            }

            $profile->{$key} = $data->$attr2;
        }

        $profile->battle_tag = $profile->battle_tag ?? $profile->hero_battle_tag;
        unset($profile->hero_battle_tag);

        $profile->class = str_replace(' ', '-', $profile->class);

        $profile->gender = $profile->gender == 'm'
            ? 1
            : 0;

        $this->leaderboard[] = (object)array_merge(
            (array)$profile,
            (array)$ladder_data,
            (array)$this->self
        );
    }

    /**
     * Retrieve ladder data from response
     *
     * @param $player
     * @return stdClass
     */
    public function getLadderData($player) : stdClass
    {
        $ladder_data = new stdClass;

        foreach ($player->data as $player_data) {
            list($attr1, $attr2) = array_keys((array)$player_data);

            $key = snake_case($player_data->$attr1);

            $ladder_data->$key = $player_data->$attr2;
        }

        return $ladder_data;
    }
}