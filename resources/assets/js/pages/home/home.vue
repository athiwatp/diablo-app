<style lang="scss">
    @import './home';
</style>

<template>
    <div id="page">
        <main-header></main-header>
        
        <banner :parameters.once="topBannerParameters">
            <div class="home-banner-content">
                <h1>Diablo Rankings</h1>
                <h6>Leaderboards, statistics and more</h6>
            </div>
        </banner>

        <section class="content">
            <div class="leaderboard">
                <div class="container-fluid leaderboard__rankings">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <h2 class="section-header">Softcore</h2>
                            <leaderboard-card :leaderboard="state.softcore"
                                              orientation="left"
                            ></leaderboard-card>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <h2 class="section-header">Hardcore</h2>
                            <leaderboard-card :leaderboard="state.hardcore"
                                              orientation="left"
                            ></leaderboard-card>
                        </div>
                    </div>
                </div>

                <div class="container-fluid leaderboard__classes">
                    <div class="row section-wrapper">
                        <div class="col-sm-12 col-md-12">
                            <h2 class="section-header">Leaderboards</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <a href="#" class="leaderboard__classes__class">
                                <img src="/img/barbarian/crest.png" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <a href="#" class="leaderboard__classes__class">
                                <img src="/img/crusader/crest.png" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <a href="#" class="leaderboard__classes__class">
                                <img src="/img/demon-hunter/crest.png" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <a href="#" class="leaderboard__classes__class">
                                <img src="/img/monk/crest.png" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <a href="#" class="leaderboard__classes__class">
                                <img src="/img/witch-doctor/crest.png" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <a href="#" class="leaderboard__classes__class">
                                <img src="/img/wizard/crest.png" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main-footer></main-footer>
    </div>
</template>

<script>
    import mainHeader from '../../components/main-header/main-header.vue';
    import banner from '../../components/banner/banner.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';
    import leaderboardCard from './components/leaderboard-card/leaderboard-card.vue';
    import homeStub from '../../stubs/home';
    import homeStore from '../../stores/home';

    export default {
        data () {
            return {
                state: homeStub,
                topBannerParameters: {
                    background: 'url("/img/bg.jpg") no-repeat fixed',
                    backgroundSize: 'cover',
                    backgroundPosition: '50% -120px'
                }
            }
        },

        props: ['data'],

        components: { mainHeader, banner, mainFooter, leaderboardCard },

        ready () {
            homeStore.get(() => {
                this.state = homeStore.state;
            });
        }
    }
</script>