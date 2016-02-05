<style lang="scss">
    section h2 {
        text-align: center;
        color: #fff;
        text-transform: uppercase;
    }

    .container h2 {
        margin: 2rem 0;
    }
</style>

<template>
    <div id="app">
        <header>
            <main-navbar></main-navbar>

            <jumbo>
                Diablo Rankings
            </jumbo>
        </header>

        <div class="container">
            <section class="leaderboards-section">
                <div class="row">
                    <h2 class="col-md-12">Leaderboards</h2>

                    <div class="col-md-6">
                        <div class="card card--diablo text-xs-right">
                            <img :src="softcoreTop" alt="" class="card-img-top">

                            <div class="card-img-overlay text-xs-left">
                                <h3 class="card-title text-uppercase">Softcore</h3>
                                <h3 class="text--tertiary">{{ state.softcore.top.rift_level }}</h3>
                                <h4 class="text--secondary">{{ state.softcore.top.hero.name }}</h4>
                                <div class="card-text">
                                    <a href="/heroes/{{ state.softcore.top.hero.id }}" class="btn btn--secondary">Go to Hero</a>
                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item--diablo"
                                    v-for="ranking in state.softcore.ladder"
                                >
                                    <div class="row">
                                        <div class="col-md-3 text-xs-center">
                                            <span class="label label--diablo">{{ ranking.rift_level }}</span>
                                        </div>
                                        <div class="col-md-4 text-xs-center text--{{ ranking.class.replace(' ', '-') }}">
                                            {{ ranking.class }}
                                        </div>
                                        <div class="col-md-5 text-md-right text-xs-center">
                                            <a href="/heroes/{{ ranking.hero.id }}">{{ ranking.hero.name }}</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item text-xs-center">
                                    <a href="#" class="btn btn--secondary-outline">View All</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card--diablo text-xs-left">
                            <img :src="hardcoreTop" alt="" class="card-img-top">

                            <div class="card-img-overlay text-xs-right">
                                <h3 class="card-title text-uppercase">Hardcore</h3>
                                <h3 class="text--tertiary">{{ state.hardcore.top.rift_level }}</h3>
                                <h4 class="text--secondary">{{ state.hardcore.top.hero.name }}</h4>
                                <div class="card-text">
                                    <a href="/heroes/{{ state.hardcore.top.hero.id }}" class="btn btn--secondary">Go to Hero</a>
                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item--diablo"
                                    v-for="ranking in state.hardcore.ladder"
                                >
                                    <div class="row">
                                        <div class="col-md-3 text-xs-center">
                                            <span class="label label--diablo">{{ ranking.rift_level }}</span>
                                        </div>
                                        <div class="col-md-4 text-xs-center text--{{ ranking.class.replace(' ', '-') }}">
                                            {{ ranking.class }}
                                        </div>
                                        <div class="col-md-5 text-md-right text-xs-center">
                                            <a href="/heroes/{{ ranking.hero.id }}">{{ ranking.hero.name }}</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item text-xs-center">
                                    <a href="#" class="btn btn--secondary-outline">View All</a>
                                </li>
                            </ul>
                        </div>
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
    import homeStore from '../../stores/home';
    import mainNavbar from '../../components/main-navbar/app.vue';
    import mainFooter from '../../components/main-footer/app.vue';
    import jumbo from '../../components/jumbotron/app.vue';
    import classCard from '../../components/cards/class.vue';

    export default {
        replace: false,

        data () {
            return {
                state: {
                    softcore: {
                        top: {
                            hero: {},
                            profile: {}
                        },
                        ladder: []
                    },
                    hardcore: {
                        top: {
                            hero: {},
                            profile: {}
                        },
                        ladder: []
                    }
                }
            }
        },

        computed: {
            softcoreTop () {
                if (typeof this.state.softcore.top.class != 'undefined') {
                    return base_url + '/img/' + this.state.softcore.top.class + '/crest.png';
                }
            },
            hardcoreTop () {
                if (typeof this.state.hardcore.top.class != 'undefined') {
                    return base_url + '/img/' + this.state.hardcore.top.class + '/crest.png';
                }
            }
        },

        components: { mainNavbar, mainFooter, jumbo, classCard },

        ready () {
            homeStore.get(function () {
                this.state = homeStore.state;
            }.bind(this));
        }
    }
</script>