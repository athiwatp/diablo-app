<?php

namespace App\Diablo\Parsers\Leaderboards;

use stdClass;

class LeaderboardParser
{
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

    /**
     * Parse the rankings
     *
     * @param $data
     * @param $limit
     * @return array
     */
    public function parse($data, int $limit = null) : array
    {
        foreach ($data as $array) {
            $this->getRankings($array, $limit);
        }

        return $this->leaderboard;
    }

    /**
     * Get the self attributes of the response
     *
     * @param $leaderboard
     * @return mixed
     */
    public function getSelf($leaderboard) : array
    {
        $self['hardcore'] = $leaderboard->hardcore ?? false;
        $self['greater_rift'] = $leaderboard->greater_rift ?? false;

        if (isset($leaderboard->season)) {
            $self['season'] = true;
            $self['period'] = $leaderboard->season;
        } else {
            $self['season'] = false;
            $self['period'] = $leaderboard->era;
        }

        $self['players'] = isset($leaderboard->greater_rift_solo_class)
            ? 1
            : $leaderboard->greater_rift_team_size;

        $explode = explode('/', $leaderboard->_links->self->href);
        $self['region'] = strtoupper(substr($explode[2], 0, 2));

        return $this->self = $self;
    }

    /**
     * Parse the rankings from the response
     *
     * @param $leaderboard
     * @param $limit
     */
    public function getRankings($leaderboard, $limit)
    {
        $this->self = $this->getSelf($leaderboard);

        $i = 0;

        foreach ($leaderboard->row as $player) {
            $ladder_data = [];

            foreach ($player->data as $player_data) {
                list($attr1, $attr2) = array_keys((array) $player_data);

                $key = snake_case($player_data->$attr1);

                if ($key === 'rank') {
                    $rank_saved = $player_data->$attr2;
                }

                $ladder_data[$key] = $player_data->$attr2;
            }

            if (! isset($ladder_data['rank'])) {
                $ladder_data['rank'] = $rank_saved;
            }

            $ranking = $this->getPlayer($player->player[0], $ladder_data);

            $ranking['battlenet_hero_id'] = $ranking['hero_id'];
            unset($ranking['hero_id']);

            if (empty($ranking['battle_tag']) || empty($ranking['hero_battle_tag'])) {
                continue;
            }

            $ranking['battle_tag'] = $ranking['battle_tag'] ?? $ranking['hero_battle_tag'];
            unset($ranking['hero_battle_tag']);

            foreach (array_keys($ranking) as $rank) {
                if (substr($rank, 0, 5) == 'hero_') {

                    $ranking[substr($rank, 5)] = $ranking[$rank];
                    unset($ranking[$rank]);
                }
            }

            $this->leaderboard[] = $ranking;
            $i++;

            if ($i === $limit) {
                break;
            }
        }
    }

    /**
     * Retrieve player data from response
     *
     * @param $player
     * @param $ladder_data
     * @return array
     */
    public function getPlayer(stdClass $player, array $ladder_data) : array
    {
        $profile = [];

        foreach ($player->data as $data) {
            list($attr1, $attr2) = array_keys((array) $data);

            $key = snake_case($data->$attr1);
            $profile[$key] = $data->$attr2;
        }

        return array_merge($profile, $ladder_data, $this->self);
    }
}