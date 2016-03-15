<style lang="scss">
    @import './home';
</style>

<template>
    <div id="page">
        <main-header>
            <banner :parameters.once="topBannerParameters"
                    id="top-banner"
            >
                <div class="home-banner-content">
                    <h1>Diablo Rankings</h1>
                    <h6>Leaderboards, statistics and more</h6>
                </div>
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
                                              :index="index + 1"
                                ></ranking-item>
                            </ul>
                            <div class="text-xs-center">
                                <a :href="state.softcore_show_all"
                                   class="btn btn--secondary"
                                >
                                    Show All <i class="fa fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--right">Hardcore</h2>
                            <ul class="list">
                                <ranking-item v-for="(index, ranking) in state.hardcore"
                                              :ranking="ranking"
                                              :index="index + 1"
                                ></ranking-item>
                            </ul>
                            <div class="text-xs-center">
                                <a :href="state.hardcore_show_all"
                                   class="btn btn--secondary"
                                >
                                    Show All <i class="fa fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <class-section></class-section>
            <team-section></team-section>
        </main-content>
    </div>
</template>

<script>
    import rankingItem from '../../components/list/ranking-item.vue';
    import classSection from '../../components/class-section/class-section.vue';
    import teamSection from '../../components/team-section/team-section.vue';
    import homeStub from '../../stubs/home';

    export default {
        data () {
            return homeStub
        },

        props: ['data'],

        components: {
            rankingItem,
            classSection,
            teamSection
        },

        ready () {
            this.init();
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            }
        }
    }
</script>