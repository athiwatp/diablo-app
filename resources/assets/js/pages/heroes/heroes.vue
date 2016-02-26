<style lang="scss">
</style>

<template>
    <div id="page">
        <main-navbar></main-navbar>

        <banner :parameters.once="topBannerParameters"
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
            <h2 class="section-header">Hero</h2>
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
                                            @click="updateProfile"
                                            :disabled="! state.queuable"
                                    >
                                        Update
                                    </button>
                                </div>
                                <div class="block__footer">
                                    <h5 class="block__footer__header">Greater rift</h5>
                                    <ul class="list">
                                        <li class="list__item m-b-0"
                                            v-for="ranking in state.leaderboards"
                                        >
                                            <span class="flex-50">{{ ranking.players }} Players</span>
                                            <span class="flex-50">{{ ranking.rift_level }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="block__footer">
                                    <div class="profile-info">
                                        <h3 class="text--tertiary profile-info__header">
                                            {{ state.paragon_level | number }}
                                        </h3>
                                        <small>paragon</small>
                                    </div>
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
                    }
                },
                topBannerParameters: {
                    background: 'url("http://3.bp.blogspot.com/-eR6-WzxRxn4/UWy-owwLWQI/AAAAAAAAQS4/Dhh6XXtFh8c/s1600/diablo-3-barbarian-wallpapers_1680x1050.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                }
            }
        },

        components: {message, banner, mainNavbar, mainFooter},

        props: ['data'],

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

        computed: {
            crest () {
                if (typeof this.state.class !== 'undefined') {
                    return BASE_URL + '/img/' + this.state.class.split(' ').join('-') + '/crest.png'
                }
            }
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