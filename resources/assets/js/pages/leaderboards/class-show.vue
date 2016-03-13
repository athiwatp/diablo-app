<template>
    <div id="page">
        <main-header>
            <banner :parameters="topBannerParameters"
                    id="top-banner"
                    class="banner--slim"
            >
                <div class="home-banner-content">
                    <h1>Class Leaderboard</h1>
                </div>
            </banner>
        </main-header>

        <main-content>
            <h2 class="section-header">Softcore</h2>
            <section class="leaderboard-rankings">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="list">
                                <ranking-item v-for="(index, ranking) in state.data"
                                              :ranking="ranking"
                                              :index="index | rank"
                                ></ranking-item>
                            </ul>
                            <div class="flex">
                                <div class="flex-50">
                                    <a :href="state.prev_page_url"
                                       class="btn btn--secondary"
                                       v-if="state.prev_page_url"
                                    >
                                        Prev
                                    </a>
                                </div>
                                <div class="flex-50 text-xs-right">
                                    <a :href="state.next_page_url"
                                       class="btn btn--secondary"
                                       v-if="state.next_page_url"
                                    >
                                        Next
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
    import rankingItem from '../../components/list/ranking-item.vue';

    export default {
        data () {
            return {
                state: {
                    current_page: 1
                },
                topBannerParameters: {
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed 50% 0'
                }
            }
        },

        filters: {
            rank (index) {
                return index + 1 + ((this.state.current_page - 1) * 25);
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