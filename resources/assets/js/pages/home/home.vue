<style lang="scss">
    @import './home';
</style>

<template>
    <div id="page">
        <main-header></main-header>
        
        <banner :parameters.once="topBannerParameters"
                id="top-banner"
        >
            <div class="home-banner-content">
                <h1>Diablo Rankings</h1>
                <h6>Leaderboards, statistics and more</h6>
            </div>
        </banner>

        <div class="content">
            <section class="leaderboard-rankings">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--left">Softcore</h2>
                            <leaderboard-card :leaderboard="state.softcore"></leaderboard-card>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h2 class="section-header section-header--right">Hardcore</h2>
                            <leaderboard-card :leaderboard="state.hardcore"></leaderboard-card>
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
                            <a href="#" 
                               class="leaderboard-classes__class"
                            >
                                <img :src="class | classCrest">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <main-footer></main-footer>
    </div>
</template>

<script>
    import mainHeader from '../../components/main-header/main-header.vue';
    import banner from '../../components/banner/banner.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';
    import leaderboardCard from './components/leaderboard-card/leaderboard-card.vue';
    import homeStub from '../../stubs/home';

    export default {
        data () {
            return {
                state: homeStub,
                topBannerParameters: {
                    background: 'url("/img/home-banner.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                },
                classes: [
                    'barbarian', 'crusader', 'demon-hunter', 'monk', 'witch-doctor', 'wizard'
                ]
            }
        },

        props: ['data'],

        components: { mainHeader, banner, mainFooter, leaderboardCard },

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