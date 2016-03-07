<template>
    <div id="page">
        <main-header>
            <banner :parameters="topBannerParameters"
                    class="banner--slim"
                    id="top-banner"
            >
                <h1>Leaderboards</h1>
            </banner>
        </main-header>

        <main-content>
            <h2 class="section-header">Classes</h2>
            <section class="leaderboard-classes">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 col-sm-6 col-xs-12"
                             v-for="class in classes"
                        >
                            <a :href="class | leaderboardClassLink"
                               class="leaderboard-classes__class"
                            >
                                <img :src="class | classCrest">
                            </a>
                            <div class="text-xs-center">
                                <h6>{{ class }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                                {{ team }}
                            </a>
                            <div class="text-xs-center">
                                <h6>{{ team }} players</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main-content>
    </div>
</template>

<script>
    import mainHeader from '../../components/main-header/main-header.vue';
    import mainContent from '../../components/main-content/main-content.vue';
    import banner from '../../components/banner/banner.vue';

    export default {
        data () {
            return {
                topBannerParameters: {
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                },
                classes: [
                    'barbarian', 'crusader', 'demon-hunter', 'monk', 'witch-doctor', 'wizard'
                ],
                teams: [
                    '2', '3', '4'
                ]
            }
        },

        filters: {
            leaderboardClassLink (c) {
                return '/leaderboards/season/' + CURRENT_SEASON + '/class/' + c.replace('-', '');
            },
            leaderboardTeamLink (c) {
                return '/leaderboards/season/' + CURRENT_SEASON + '/team/' + c;
            }
        },

        components: {mainHeader, mainContent, banner}
    }
</script>