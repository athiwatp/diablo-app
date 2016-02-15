<style lang="scss">
    @import './home';
</style>

<template>
    <section id="page">
        <main-header></main-header>

        <section class="content">
            <div class="banner">
                <div class="banner__image"></div>
                <div class="banner__text">
                    <div class="container">
                        <h1>Diablo Rankings</h1>
                        <h6>Leaderboards, statistics and more</h6>
                    </div>
                </div>
            </div>

            <div class="leaderboard">
                <div class="container-fluid leaderboard__rankings">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Softcore</h2>
                            <leaderboard-card :leaderboard="state.softcore"
                                              orientation="left"
                            ></leaderboard-card>
                        </div>
                        <div class="col-md-6">
                            <h2>Hardcore</h2>
                            <leaderboard-card :leaderboard="state.hardcore"
                                              orientation="left"
                            ></leaderboard-card>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
    import mainHeader from '../../components/main-header/main-header.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';
    import leaderboardCard from './components/leaderboard-card/leaderboard-card.vue';
    import homeStub from '../../stubs/home';
    import homeStore from '../../stores/home';

    export default {
        data () {
            return {
                state: homeStub
            }
        },

        props: ['data'],

        components: { mainHeader, mainFooter, leaderboardCard },

        ready () {
            homeStore.get(() => {
                this.state = homeStore.state;
            });
        }
    }
</script>