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
                                <ranking-item v-for="(index, ranking) in state.data"
                                          :ranking="ranking"
                                          :index="index"
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
    import mainHeader from '../../components/main-header/main-header.vue';
    import mainContent from '../../components/main-content/main-content.vue';
    import banner from '../../components/banner/banner.vue';
    import rankingItem from '../../components/list/ranking-item.vue';

    export default {
        data () {
            return {
                state: {},
                topBannerParameters: {
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                }
            }
        },

        ready () {
            this.init();
        },

        props: ['data'],

        components: {mainHeader, mainContent, banner, rankingItem},

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            }
        }
    }
</script>