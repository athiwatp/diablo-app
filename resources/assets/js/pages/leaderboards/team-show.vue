<template>
    <div id="page">
        <main-header>
            <banner :parameters="topBannerParameters"
                    id="top-banner"
                    class="banner--slim"
            >
                <h1>Class Leaderboard</h1>
            </banner>
        </main-header>

        <main-content>
            <h2 class="section-header">Softcore</h2>
            <section class="leaderboard-rankings">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="list">
                                <team-ranking-item v-for="(index, ranking) in state.parsed"
                                          :ranking="ranking"
                                          :index="index"
                                ></team-ranking-item>
                            </ul>
                            <div class="flex">
                                <div class="flex-50">
                                    <a :href="state.prev_page_url"
                                       class="btn btn--secondary btn--icon-left"
                                       v-if="state.prev_page_url"
                                    >
                                        <i class="fa fa-angle-left"></i> Prev
                                    </a>
                                </div>
                                <div class="flex-50 text-xs-right">
                                    <a :href="state.next_page_url"
                                       class="btn btn--secondary btn--icon"
                                       v-if="state.next_page_url"
                                    >
                                        Next <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
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

    export default {
        data () {
            return {
                state: {},
                topBannerParameters: {
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed 50% 0',
                }
            }
        },

        ready () {
            this.init();
        },

        props: ['data'],

        components: {
            teamRankingItem
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            }
        }
    }
</script>