<style lang="scss">
    @import './profile-show.scss';
</style>

<template>
    <div id="page"
         class="profile-page"
    >
        <main-header>
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
        </main-header>

        <main-content>
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
                                            :disabled="! state.queueable"
                                    >
                                        Update <i class="fa fa-refresh"></i>
                                    </button>
                                    <bounce v-if="loadingAnimation"
                                            transition="fade"
                                            class="animated"
                                    ></bounce>
                                </div>
                                <div class="block__body block__body--flush"
                                     v-if="state.rift_rankings.length > 0"
                                >
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
                                     transition="fade"
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
                        <div class="col-md-8 col-sm-12 col-xs-12"
                             v-if="state.heroes.length > 0"
                        >
                            <ul class="list">
                                <li class="list__item list__item--header">
                                    <span class="flex-30">Name</span>
                                    <span class="flex-30">Class</span>
                                    <span class="flex-20">Paragon Level</span>
                                    <span class="flex flex-20 text-xs-center">Mode</span>
                                </li>
                                <a class="list__item list__item--link list__item--link--{{ hero.hardcore ? 'hardcore' : 'softcore' }}"
                                    v-for="hero in state.heroes"
                                    stagger="100"
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
                                        <span class="text--{{ hero.class }}">
                                            {{ hero.class | capitalize }}
                                        </span>
                                    </span>
                                    <span class="flex-20">{{ hero.paragon_level }}</span>
                                    <span class="flex flex-20 text-xs-center">
                                        {{ hero.season ? 'Season' : 'Era'}}
                                        <span class="list__item--link__arrow">
                                            <i class="fa fa-angle-right"></i>
                                        </span>
                                    </span>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </main-content>
    </div>
</template>

<script>
    import profileStub from '../../stubs/profile';

    export default {
        data: function () {
            return {
                state: profileStub,
                topBannerParameters: {
                    background: 'url("/img/profile-banner.jpg") no-repeat fixed 50% 0'
                },
                loadingAnimation: false
            }
        },

        props: ['data'],

        ready () {
            this.init();
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);

                if (this.state.stats == null) {
                    this.$root.message('warning', 'New Profile.');
                }
            },

            updateProfile () {
                this.loadingAnimation = true;
                this.state.queueable = false;
                this.$root.message('info', 'Profile is currently in queue.');
                this.$http.patch('/api/profiles/' + this.state.id).then(function (response) {
                    this.state = response.data;
                    this.loadingAnimation = false;
                    this.$root.message('success', 'Profile updated', 4000);
                }.bind(this), function (response) {
                    this.loadingAnimation = false;
                    this.$root.message('warning', response.data);
                }.bind(this));
            }
        }
    }
</script>