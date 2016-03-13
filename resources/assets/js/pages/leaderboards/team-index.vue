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
                                <ranking-item v-for="(index, ranking) in state.softcore"
                                          :ranking="ranking"
                                          :index="index"
                                ></ranking-item>
                            </ul>
                            <div class="text-xs-center">
                                <a :href="state.softcore_show_all"
                                   class="btn btn--secondary"
                                >
                                    Show All
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--right">Hardcore</h2>
                            <ul class="list">
                                <ranking-item v-for="(index, ranking) in state.hardcore"
                                          :ranking="ranking"
                                          :index="index"
                                ></ranking-item>
                            </ul>
                            <div class="text-xs-center">
                                <a :href="state.hardcore_show_all"
                                   class="btn btn--secondary"
                                >
                                    Show All
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
    import rankingItem from '../../components/list/ranking-item.vue';

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
            rankingItem
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            }
        }
    }
</script>