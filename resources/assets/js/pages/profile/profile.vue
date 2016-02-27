<style lang="scss">
    @import './profile.scss';
</style>

<template>
    <div id="page"
         class="profile-page"
    >

        <main-navbar></main-navbar>

        <banner :parameters.once="topBannerParameters"
                id="top-banner"
                class="banner--slim"
        >
            <div>
                <h1>{{ state.battle_tag }}</h1>
                <h3>{{ state.stats && state.stats.clan_name || '' }}</h3>
                <h6>{{ state.region | region}}</h6>
            </div>
        </banner>

        <div class="content">
            <message></message>
            <h2 class="section-header">Profile</h2>
            <section class="profile-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="block">
                                <div class="block__body">
                                    <a href="#"
                                       class="battlenet-link"
                                    >
                                        Battle.net
                                    </a>
                                    <p>
                                        <small>Update Available: {{ state.available_in || 'Now' }}</small>
                                    </p>
                                    <button class="btn btn--secondary btn-lg"
                                            @click="updateProfile"
                                            :disabled="! state.queuable"
                                    >
                                        Update
                                    </button>
                                </div>
                                <div class="block__body block__body--flush">
                                    <div class="block__row">
                                        <h5 class="block__header">Greater rift</h5>
                                        <ul class="list">
                                            <li class="list__item"
                                                v-for="ranking in state.rift_rankings"
                                            >
                                                <span class="flex-50">{{ ranking.players == 1 ? 'Solo' : ranking.players + ' Players' }}</span>
                                                <span class="flex-50">{{ ranking.rift_level }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="block__body"
                                     v-if="state.stats"
                                >
                                    <div class="block__row">
                                        <h5 class="block__header">Season</h5>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12 block__col divider">
                                                <h3 class="text--tertiary block__col__header">
                                                    {{ state.stats.paragon_level_season | number }}
                                                </h3>
                                                <small>softcore</small>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 block__col">
                                                <h3 class="text--secondary block__col__header">
                                                    {{ state.stats.paragon_level_season_hardcore | number }}
                                                </h3>
                                                <small>hardcore</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block__row">
                                        <h5 class="block__header">Era</h5>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12 block__col divider">
                                                <h3 class="text--tertiary block__col__header">
                                                    {{ state.stats.paragon_level | number }}
                                                </h3>
                                                <small>softcore</small>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 block__col">
                                                <h3 class="text--secondary block__col__header">
                                                    {{ state.stats.paragon_level_hardcore | number }}
                                                </h3>
                                                <small>hardcore</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block__row">
                                        <h5 class="block__header">Statistics</h5>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12 block__col divider">
                                                <h5 class="text--quaternary block__col__header">
                                                    {{ state.stats.kills_monsters | number }}
                                                </h5>
                                                <small>monsters</small>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 block__col">
                                                <h5 class="text--quaternary block__col__header">
                                                    {{ state.stats.kills_elites | number }}
                                                </h5>
                                                <small>elites</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <ul class="list">
                                <li class="list__item list__item--header">
                                    <span class="flex-30">Name</span>
                                    <span class="flex-30">Class</span>
                                    <span class="flex-20">Paragon Level</span>
                                    <span class="flex-20 text-xs-right">Mode</span>
                                </li>
                                <a class="list__item list__item--link list__item--link--{{ hero.hardcore ? 'hardcore' : 'softcore' }}"
                                    v-for="hero in state.heroes"
                                    href="/heroes/{{ hero.id }}"
                                >

                                    <span class="flex-30"
                                          v-if="hero.name"
                                    >
                                        {{ hero.name }}
                                    </span>
                                    <span class="flex-30"
                                          v-else
                                    >
                                        <i class="fa fa-warning"></i> New Hero Record
                                    </span>
                                    <span class="flex-30">
                                        <img :src="hero | classPortrait"
                                             alt="portrait"
                                             class="class-portrait"
                                        >
                                        {{ hero.class | capitalize }}
                                    </span>
                                    <span class="flex-20">{{ hero.paragon_level }}</span>
                                    <span class="flex-20 text-xs-right">
                                        {{ hero.season ? 'Season' : 'Era'}}
                                    </span>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <main-footer></main-footer>
        </div>
    </div>
</template>
<script>
    import message from '../../components/message/message.vue';
    import banner from '../../components/banner/banner.vue';
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';

    export default {
        data: function () {
            return {
                state: {
                    heroes: [],
                    stats: {
                        paragon_level: 0,
                        paragon_level_hardcore: 0,
                        paragon_level_season: 0,
                        paragon_level_season_hardcore: 0,
                        kills_monsters: 0,
                        kills_elites: 0
                    },
                    queuable: true
                },
                topBannerParameters: {
                    background: 'url("/img/profile-banner.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                }
            }
        },

        props: ['data'],

        components: {message, banner, mainNavbar, mainFooter},

        watch: {
            'state.queued' (value) {
                if (value == true) {
                    this.$broadcast('message:show', 'success', 'fa-refresh', 'Profile is currently in queue');
                } else {
                    this.$broadcast('message:hide');
                }
            }
        },

        ready () {
            this.init();
        },

        methods: {
            showNewProfileMessage () {
                this.$broadcast('message:show', 'warning', 'fa-warning', 'New Profile Record');
            },

            init () {
                this.state = JSON.parse(this.data);

                if (this.state.stats == null) {
                    this.showNewProfileMessage();
                }
            },

            updateProfile () {
                this.state.queued = true;
                this.state.queuable = false;
                this.$http.patch('/api/profiles/' + this.state.id);
            }
        }
    }
</script>