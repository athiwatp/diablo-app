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
    private $needs_record;
    private $test = [];

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
    public function parse(array $data) : array
    {
        foreach ($data as $array) {
            $this->getRankings($array);
        }

        return $this->leaderboard;
    }

    /**
     * Parse the rankings from the response
     *
     * @param array $leaderboard
     * @param int $limit
     */
    public function getRankings(stdClass $leaderboard)
    {
        $this->getSelf($leaderboard);

        $i = 0;
        foreach ($leaderboard->row as $record) {
            $this->getLeaderboardData($record);

            $i++;

            switch($this->self->players) {
                case 1:
                    if ($i == 100) {
                        break 2;
                    }
                break;
            }
        }

        $this->findOrphans();
    }

    /**
     * I'm going to fix this don't worry
     */
    private function findOrphans()
    {
        $this->count = 0;
        foreach ($this->leaderboard as $record) {
            $record['players'] = array_map(function ($i) {
                if (!isset($i->battlenet_hero_id)) {
                    if (array_key_exists($i->battle_tag, $this->purgatory)) {
                        $i->battlenet_hero_id = $this->purgatory[$i->battle_tag]->battlenet_hero_id;
                    }
                }
            }, $record['players']);
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

    public function getLeaderboardData($record)
    {
        $players = $this->getPlayersData($record->player);
        $data = array_merge(
            (array) $this->parseJson($record->data),
            (array) $this->self
        );


        if (!isset($data['rank'])) {
            if (empty($players[0])) {
                return;
            }
            $this->purgatory[$data['battle_tag']] = $players[0];
        } else {
            $this->leaderboard[] = compact('players', 'data');
        }
    }

    /**
     * @param $players
     */
    public function getPlayersData(array $players) : array
    {
        $bnet_players = [];

        foreach ($players as $player) {
            if (empty($player->battle_tag) && empty($player->hero_battle_tag)) {
                continue;
            }

            $data = $this->getPlayerData($player->data);

            if (!isset($data->battlenet_hero_id)) {
                if (isset($this->test[$data->battle_tag])) {
                    unset($this->test[$data->battle_tag]);
                } else {
                    $this->test[$data->battle_tag] = '';
                }
            }
            $bnet_players[] = $data;
        }

        return $bnet_players;
    }

    /**
     * Retrieve player data from response
     *
     * @param array $players
     */
    public function getPlayerData(array $player) : stdClass
    {
        $profile = $this->parseJson($player);

        $profile->battle_tag = $profile->battle_tag ?? $profile->hero_battle_tag;
        unset($profile->hero_battle_tag);

        $profile->class = str_replace(' ', '-', $profile->class);

        $profile->gender = $profile->gender == 'm'
            ? 1
            : 0;

        $profile = array_merge(
            (array) $profile,
            (array) $this->self
        );

        return (object) $profile;
    }

    /**
     * @param $json
     * @return stdClass
     */
    public function parseJson($json) : stdClass
    {
        $ladder_data = new stdClass;

        foreach ($json as $data) {
            list($attr1, $attr2) = array_keys((array)$data);

            $key = snake_case($data->$attr1);

            if (substr($key, 0, 5) == 'hero_') {
                $key = $key !== 'hero_id'
                    ? str_replace('hero_', '', $key)
                    : 'battlenet_hero_id';
            }

            $ladder_data->$key = $data->$attr2;
        }

        return $ladder_data;
    }
}