<template>
    <h2 class="section-header">Teams</h2>
    <section class="leaderboard-teams">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 text-xs-center"
                     v-for="team in teams"
                >
                    <a :href="team | leaderboardTeamLink"
                       class="leaderboard-teams__team"
                    >
                        <img :src="team | teamCrest">
                        <span class="leaderboard-teams__team__sub-text">{{ team }} Players</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data () {
            return {
                teams: [
                    '2', '3', '4'
                ]
            }
        },

        filters: {
            leaderboardTeamLink (c) {
                return '/leaderboards/filter/preview?season=1&period=' + CURRENT_SEASON + '&players=' + c;
            }
        }
    }
</script>