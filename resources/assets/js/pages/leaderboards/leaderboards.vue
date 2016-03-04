<style xmlns:v-el="http://www.w3.org/1999/xhtml" xmlns:v-el="http://www.w3.org/1999/xhtml">
    .pager li a {
        border-radius: 0;
    }
</style>

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
            <section class="leaderboard-rankings">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--left">Softcore</h2>
                            <leaderboard-card :leaderboard="state.softcore.data"></leaderboard-card>
                            <div>
                                <a href="#"
                                   @click.prevent="prevPage"
                                   class="btn btn--secondary pull-xs-left"
                                   v-if="state.softcore.prev_page_url"
                                >
                                    Previous
                                </a>
                                <a href="#"
                                   @click.prevent="nextPage"
                                   class="btn btn--secondary pull-xs-right"
                                   v-if="state.softcore.next_page_url"
                                >
                                    Next
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--right">Hardcore</h2>
                            <leaderboard-card :leaderboard="state.hardcore.data"></leaderboard-card>
                            <div>
                                <a href="#"
                                   @click.prevent="prevPage"
                                   class="btn btn--secondary pull-xs-left"
                                   v-if="state.hardcore.prev_page_url"
                                >
                                    Previous
                                </a>
                                <a href="#"
                                   @click.prevent="nextPage"
                                   class="btn btn--secondary pull-xs-right"
                                   v-if="state.hardcore.next_page_url"
                                >
                                    Next
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
    import mainHeader from '../../components/main-header/main-header.vue';
    import mainContent from '../../components/main-content/main-content.vue';
    import banner from '../../components/banner/banner.vue';
    import leaderboardCard from '../../components/leaderboard-card/leaderboard-card.vue';

    export default {
        data () {
            return {
                state: {
                    softcore: {
                        next_page_url: '',
                        prev_page_url: '',
                        data: []
                    },
                    hardcore: {
                        next_page_url: '',
                        prev_page_url: '',
                        data: []
                    }
                },
                topBannerParameters: {
                    background: 'url("http://digitalart.io/wp-content/uploads/2014/04/Mathael-Angels-Death-Diablo-III-Wallpaper.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                },
                currentPage: 1,
            }
        },

        ready () {
            this.init();
        },

        props: ['data'],

        components: {mainHeader, mainContent, banner, leaderboardCard},

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            },

            nextPage () {
                this.currentPage++;
                this.$http.get(this.queryPage(), {page: this.currentPage}, function (state) {
                    this.state = state;
                });
            },

            prevPage () {
                this.currentPage--;
                this.$http.get(this.queryPage(), {page: this.currentPage}, function (state) {
                    this.state = state;
                });
            }
        }
    }
</script>