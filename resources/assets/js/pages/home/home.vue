<style lang="scss">
    @import './_home.scss';
</style>

<template>
    <div id="page">
        <header>
            <main-navbar></main-navbar>

            <jumbo>
                Diablo Rankings
            </jumbo>
        </header>

        <div id="home"
             class="container"
        >
            <section class="leaderboards-section">
                <div class="row">
                    <h2 class="col-md-12">Season Leaderboards</h2>

                    <div class="col-md-6">
                        <leaderboard-card :leaderboard="state.softcore"
                                          orientation="left"
                        >
                            Softcore
                        </leaderboard-card>
                    </div>

                    <div class="col-md-6">
                        <leaderboard-card :leaderboard="state.hardcore"
                                          orientation="right"
                        >
                            Hardcore
                        </leaderboard-card>
                    </div>
                </div>
            </section>

            <section class="classes-section">
                <div class="row">
                    <h2 class="col-md-12">Classes</h2>

                    <div class="col-md-2">
                        <class-card img="/img/barbarian/crest.png">Barbarian</class-card>
                    </div>

                    <div class="col-md-2">
                        <class-card img="/img/crusader/crest.png">Crusader</class-card>
                    </div>

                    <div class="col-md-2">
                        <class-card img="/img/demon-hunter/crest.png">Demon Hunter</class-card>
                    </div>

                    <div class="col-md-2">
                        <class-card img="/img/monk/crest.png">Monk</class-card>
                    </div>

                    <div class="col-md-2">
                        <class-card img="/img/witch-doctor/crest.png">Witch Doctor</class-card>
                    </div>

                    <div class="col-md-2">
                        <class-card img="/img/wizard/crest.png">Wizard</class-card>
                    </div>
                </div>
            </section>

            <section class="teams-section">
                <div class="row">
                    <h2 class="col-md-12">Teams</h2>

                    <div class="col-md-4">
                        <class-card class="card--class-tint" img="/img/team/2-players.jpg">2 Players</class-card>
                    </div>

                    <div class="col-md-4">
                        <class-card class="card--class-tint" img="/img/team/3-players.jpg">3 Players</class-card>
                    </div>

                    <div class="col-md-4">
                        <class-card class="card--class-tint" img="/img/team/4-players.jpg">4 Players</class-card>
                    </div>
                </div>
            </section>
        </div>

        <main-footer></main-footer>
    </div>
</template>

<script>
    import homeStub from '../../stubs/home';
    import homeStore from '../../stores/home';
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';
    import jumbo from '../../components/jumbotron/jumbo.vue';
    import classCard from '../../components/cards/class.vue';
    import leaderboardCard from './components/leaderboard-card/leaderboard-card.vue';

    export default {
        data () {
            return {
                state: homeStub
            }
        },

        components: { mainNavbar, mainFooter, jumbo, classCard, leaderboardCard },

        ready () {
            homeStore.get(function () {
                this.state = homeStore.state;
            }.bind(this));
        }
    }
</script>