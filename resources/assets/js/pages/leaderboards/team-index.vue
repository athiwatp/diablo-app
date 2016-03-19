<template>
    <div id="page">
        <main-header>
            <banner :parameters="topBannerParameters"
                    id="top-banner"
                    class="banner--slim"
            >
                <h1>Team Leaderboard</h1>
            </banner>
        </main-header>

        <main-content>
            <section class="leaderboard-rankings">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--left">Softcore</h2>
                            <ul class="list">
                                <team-ranking-item-header></team-ranking-item-header>
                                <team-ranking-item v-for="(index, ranking) in state.softcore"
                                          :ranking="ranking"
                                          :index="index"
                                ></team-ranking-item>
                            </ul>
                            <div class="text-xs-center">
                                <a :href="state.softcore_show_all"
                                   class="btn btn--secondary btn--icon"
                                >
                                    Show All <i class="fa fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--right">Hardcore</h2>
                            <ul class="list">
                                <team-ranking-item-header></team-ranking-item-header>
                                <team-ranking-item v-for="(index, ranking) in state.hardcore"
                                                   :ranking="ranking"
                                                   :index="index"
                                ></team-ranking-item>
                            </ul>
                            <div class="text-xs-center">
                                <a :href="state.hardcore_show_all"
                                   class="btn btn--secondary btn--icon"
                                >
                                    Show All <i class="fa fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main-content>
    </div>
</template>

<script>
    import teamRankingItem from '../../components/list/team-ranking-item.vue';
    import teamRankingItemHeader from '../../components/list/team-ranking-item-header.vue';

    export default {
        data () {
            return {
                state: {
                    softcore: [],
                    hardcore: []
                },
                topBannerParameters: {
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed 50% 0'
                }
            }
        },

        ready () {
            this.init();
        },

        props: ['data'],

        components: {
            teamRankingItem,
            teamRankingItemHeader
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            }
        }
    }
</script>