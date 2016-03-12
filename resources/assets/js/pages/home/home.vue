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
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--right">Hardcore</h2>
                            <ul class="list">
                                <ranking-item v-for="(index, ranking) in state.hardcore"
                                              :ranking="ranking"
                                              :index="index + 1"
                                ></ranking-item>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
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
                        </div>
                    </div>
                </div>
            </section>
        </main-content>
    </div>
</template>

<script>
    import mainHeader from '../../components/main-header/main-header.vue';
    import banner from '../../components/banner/banner.vue';
    import mainContent from '../../components/main-content/main-content.vue';
    import rankingItem from '../../components/list/ranking-item.vue';
    import homeStub from '../../stubs/home';

    export default {
        data () {
            return homeStub
        },

        props: ['data'],

        components: {
            mainHeader, 
            banner, 
            mainContent, 
            rankingItem
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