<style lang="scss">
    @import '../../../sass/mixins';

    .profile-page .banner {
        height: 450px;
    }

    .content {
        margin-top: 0.5rem;
    }

    .profile-section {
        padding: 0 1rem;
    }

    .block {
        .block__footer:not(:last-child) {
            margin-bottom: .5rem;
        }
    }

    .list {
        @include m('profile') {
            li {
                display: flex;
                align-items: center;
            }

            @include e('title') {
                text-align: left;
            }

            @include e('statistic') {
                font-weight: 900;
                font-size: 2rem;
                text-align: right;

                @include m('small') {
                    font-size: 1.5rem;
                    text-align: right;
                }
            }
        }
    }
</style>
<template>
    <div id="page"
         class="profile-page"
    >

        <main-navbar :page="page"></main-navbar>

        <banner :parameters.once="topBannerParameters">
            <div>
                <h1>{{ state.battle_tag }}</h1>
                <h6>{{ state.region | region}}</h6>
            </div>
        </banner>

        <div class="content">
            <message></message>
            <h2 class="section-header">Profile</h2>
            <section class="profile-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="block">
                                <div class="block__body">
                                    <a href="#">Battle.net</a>
                                    <p>
                                        <small>Last Updated: {{ state.updated_at || 'Never' }}</small>
                                    </p>
                                    <button class="btn btn--secondary btn-lg"
                                            @click="updateProfile"
                                    >
                                        Update
                                    </button>
                                </div>
                                <div class="block__footer">
                                    <h5 class="block__footer__header">Greater rift</h5>
                                    <ul class="list">
                                        <li class="list__item"
                                            v-for="ranking in state.rift_rankings"
                                        >
                                            <span class="flex-50">{{ ranking.players }} Players</span>
                                            <span class="flex-50">{{ ranking.rift_level }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="block__footer">
                                    <h5 class="block__footer__header">Season</h5>
                                    <ul class="list list--profile">
                                        <li>
                                            <span class="flex-50 list--profile__title">
                                                Paragon
                                            </span>
                                            <span class="flex-50 text--tertiary list--profile__statistic"
                                                  v-text="state.stats.paragon_level_season | number"
                                            ></span>
                                        </li>
                                        <li>
                                            <span class="flex-50 list--profile__title">
                                                Paragon Hardcore
                                            </span>
                                            <span class="flex-50 text--quinary list--profile__statistic"
                                                  v-text="state.stats.paragon_level_season_hardcore | number"
                                            ></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="block__footer">
                                    <h5 class="block__footer__header">Era</h5>
                                    <ul class="list list--profile">
                                        <li>
                                            <span class="flex-50 list--profile__title">
                                                Paragon
                                            </span>
                                            <span class="flex-50 text--quaternary list--profile__statistic"
                                                  v-text="state.stats.paragon_level | number"
                                            ></span>
                                        </li>
                                        <li>
                                            <span class="flex-50 list--profile__title">
                                                Paragon Hardcore
                                            </span>
                                            <span class="flex-50 text--secondary list--profile__statistic"
                                                  v-text="state.stats.paragon_level_hardcore | number"
                                            ></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="block__footer">
                                    <h5 class="block__footer__header">Statistics</h5>
                                    <ul class="list list--profile">
                                        <li>
                                            <span class="flex-50 list--profile__title">
                                                Monster Kills
                                            </span>
                                            <span class="flex-50 list--profile__statistic--small"
                                                  v-text="state.stats.kills_monsters | number"
                                            ></span>
                                        </li>
                                        <li>
                                            <span class="flex-50 list--profile__title">
                                                Elite Kills
                                            </span>
                                            <span class="flex-50 list--profile__statistic--small"
                                                  v-text="state.stats.kills_elites | number"
                                            ></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <ul class="list">
                                <li class="list__item list__item--header">
                                    <span class="flex-30">Name</span>
                                    <span class="flex-30">Class</span>
                                    <span class="flex-20">Paragon Level</span>
                                    <span class="flex-20 text-xs-right">Mode</span>
                                </li>
                                <a class="list__item list__item--link"
                                    v-for="hero in state.heroes"
                                    href="#"
                                >

                                    <span class="flex-30"
                                          v-if="hero.name"
                                    >
                                        {{ hero.name }}
                                    </span>
                                    <span class="flex-30"
                                          v-else
                                    >
                                        <i class="fa fa-check-circle"></i> New Record
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
                        paragon_level_hardore: 0,
                        paragon_level_season: 0,
                        paragon_level_season_hardcore: 0,
                        kills_monsters: 0,
                        kills_elites: 0
                    }
                },
                topBannerParameters: {
                    background: 'url("http://html.nkdev.info/youplay/dark/assets/images/banner-blog-bg.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                }
            }
        },

        props: ['data', 'page'],

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
            init () {
                this.state = JSON.parse(this.data);
            },

            updateProfile () {
                this.state.queued = true;
                this.$http.patch('/api/profiles/' + this.state.id);
            }
        }
    }
</script>