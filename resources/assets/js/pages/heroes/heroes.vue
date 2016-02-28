<style lang="scss">
</style>

<template>
    <div id="page">
        <main-navbar></main-navbar>

        <banner :parameters="topBannerParameters"
                id="top-banner"
                class="banner--slim"
        >
            <div>
                <h1>{{ state.name || 'New Record' }}</h1>
                <h3>{{ state.clan_name || '' }}</h3>
                <h6>{{ state.region | region}}</h6>
            </div>
        </banner>

        <div class="content">
            <message></message>
            <h2 class="section-header">
                Hero
            </h2>
            <section class="hero-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="block">
                                <div class="block__body">
                                    <img :src="state.class | classCrest"
                                         alt="portrait"
                                         class="img-fluid img-center"
                                    >
                                    <a href="#"
                                       class="battlenet-link"
                                    >
                                        Battle.net
                                    </a>
                                    <p>
                                        <small>Update Available: {{ state.available_in || 'Now' }}</small>
                                    </p>
                                    <button class="btn btn--secondary btn-lg"
                                            @click="updateHero"
                                            :disabled="! state.queuable"
                                    >
                                        Update
                                    </button>
                                </div>
                                <div class="block__body block__body--flush"
                                     v-if="state.season_rankings.length > 0"
                                >
                                    <div class="block__row">
                                        <h5 class="block__header">Greater rift</h5>
                                        <ul class="list">
                                            <li class="list__item"
                                                v-for="ranking in state.season_rankings"
                                            >
                                                <span class="flex-50">{{ ranking.players == 1 ? 'Solo' : ranking.players + ' Players' }}</span>
                                                <span class="flex-50">{{ ranking.rift_level }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="block__body">
                                    <div class="block__row">
                                        <h5 class="block__header">
                                            {{ state.season ? 'Season' : 'Era' }}
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 block__col">
                                                <h3 class="text--tertiary block__col__header">
                                                    {{ state.paragon_level | number }}
                                                </h3>
                                                <small>paragon</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block__body">
                                    <a href="/profiles/{{ this.state.profile_id }}"
                                       class="btn btn--secondary"
                                    >
                                        Back to Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row" style="justify-content: center;">
                                <div class="col-md-4 m-b-1"
                                     v-for="item in state.items"
                                >
                                    <a href="#"
                                       class="block block--gear"
                                       data-d3tooltip="{{ item.pivot.tool_tip_params }}"
                                    >
                                        <div class="block__body">
                                            <img :src="item.icon | powerIcon" alt="" class="block--gear__img">
                                            <p class="block--gear__text">
                                                {{ item.name }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <main-footer></main-footer>
    </div>
</template>

<script>
    import message from '../../components/message/message.vue';
    import banner from '../../components/banner/banner.vue';
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';

    export default {
        data () {
            return {
                state: {
                    paragon_level: 0,
                    stats: {
                        damage: 0,
                        toughness: 0,
                        healing: 0
                    },
                    season_rankings: []
                }
            }
        },

        props: ['data'],

        components: {message, banner, mainNavbar, mainFooter},

        computed: {
            topBannerParameters () {
                return {
                    background: 'url("/img/' + this.state.class + '/banner.jpg") no-repeat fixed 50% 0',
                }
            }
        },

        filters: {
            active (obj) {
                if (typeof obj != 'undefined') {
                    return obj.filter(function ($i) {
                        if ($i.type == 'active') {
                            return $i;
                        }
                    });
                }
            },

            passive (obj) {
                if (typeof obj != 'undefined') {
                    return obj.filter(function ($i) {
                        if ($i.type == 'passive') {
                            return $i;
                        }
                    });
                }
            },

            skillIcon (icon) {
                return 'http://media.blizzard.com/d3/icons/skills/21/' + icon + '.png'
            },

            powerIcon (icon) {
                return 'http://media.blizzard.com/d3/icons/items/small/' + icon + '.png';
            }
        },


        watch: {
            'state.queued' (value) {
                if (value == true) {
                    this.$broadcast('message:show', 'success', 'fa-refresh', 'Hero is currently in queue');
                } else {
                    this.$broadcast('message:hide');
                }
            }
        },

        ready () {
            this.init();
        },

        methods: {
            showNewHeroMessage () {
                this.$broadcast('message:show', 'warning', 'fa-warning', 'New Hero Record');
            },

            init () {
                this.state = JSON.parse(this.data);

                if (this.state.stats == null) {
                    this.showNewHeroMessage();
                }
            },

            updateHero () {
                this.state.queued = true;
                this.state.queuable = false;
                this.$http.patch('/api/heroes/' + this.state.id);
            }
        }
    }
</script>