<style lang="scss">
    @import './heroes';
</style>

<template>
    <div id="page">
        <main-header>
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
        </main-header>

        <main-content>
            <h2 class="section-header">
                Hero
            </h2>
            <section class="hero-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
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
                        <div class="col-md-9 col-sm-9 col-xs-12 text-xs-center p-t-3"
                             v-if="!state.queued_at"
                        >
                            <h1>
                                <i class="fa fa-exclamation-triangle"></i>
                                New Hero Record
                            </h1>
                            <h6>To refresh this hero's profile, click update.</h6>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 animated"
                             v-if="state.items.length > 0"
                             transition="fade"
                        >
                            <div class="row" style="justify-content: center;">
                                <div class="col-md-4 col-sm-4 col-xs-12"
                                     v-for="item in state.items"
                                     style="margin-bottom: .5rem"
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
                        <div class="col-md-3 col-sm-3 col-xs-12 animated"
                             v-if="state.skills.length > 0 || state.powers.length > 0"
                             transition="fade"
                        >
                            <div class="block">
                                <div class="block__body block__body--flush">
                                    <div class="block__row"
                                         v-if="state.skills.length > 0"
                                    >
                                        <h5 class="block__header">Active</h5>
                                        <ul class="list">
                                            <a class="list__item list__item--link list__item--link--power"
                                               v-for="skill in state.skills | active"
                                               href="http://us.battle.net/d3/en/class/{{ state.class.split(' ').join('-') }}/active/{{ skill.slug }}?runeType={{ skill.rune_type }}"
                                            >
                                                <span class="flex-70 text-xs-left">
                                                    <div>{{ skill.name }}</div>
                                                    <small class="text--quinary">{{ skill.rune }}</small>
                                                </span>
                                                <span class="flex-30 text-xs-right">
                                                    <img :src="skill.icon | skillIcon" alt="">
                                                </span>
                                            </a>
                                        </ul>
                                    </div>
                                    <div class="block__row"
                                         v-if="state.skills.length > 0"
                                    >
                                        <h5 class="block__header">Passive</h5>
                                        <ul class="list">
                                            <a class="list__item list__item--link list__item--link--power"
                                               v-for="skill in state.skills | passive"
                                               href="http://us.battle.net/d3/en/class/{{ state.class.split(' ').join('-') }}/passive/{{ skill.slug }}"
                                            >
                                                <span class="flex-70 text-xs-left">
                                                    <div>{{ skill.name }}</div>
                                                </span>
                                                <span class="flex-30 text-xs-right">
                                                    <img :src="skill.icon | skillIcon" alt="">
                                                </span>
                                            </a>
                                        </ul>
                                    </div>
                                    <div class="block__row"
                                         v-if="state.powers.length > 0"
                                    >
                                        <h5 class="block__header">Powers</h5>
                                        <ul class="list">
                                            <a class="list__item list__item--link list__item--link--power"
                                               v-for="power in state.powers"
                                               data-d3tooltip="{{ power.tool_tip_params }}"
                                            >
                                                <span class="flex-70 text-xs-left">
                                                    {{ power.name }}
                                                </span>
                                                <span class="flex-30 text-xs-right">
                                                    <img :src="power.icon | powerIcon" alt="">
                                                </span>
                                            </a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main-content>
    </div>
</template>

<script>
    import banner from '../../components/banner/banner.vue';
    import mainHeader from '../../components/main-header/main-header.vue';
    import mainContent from '../../components/main-content/main-content.vue';
    import heroStub from '../../stubs/hero';

    export default {
        data () {
            return {
                state: heroStub
            }
        },

        props: ['data'],

        components: {banner, mainHeader, mainContent},

        computed: {
            topBannerParameters () {
                if (this.state.class == '') {
                    return;
                }

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

        ready () {
            this.init();
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);

                if (this.state.stats == null) {
                    this.$root.message('warning', 'New Hero Record');
                }
            },

            updateHero () {
                this.state.queuable = false;
                this.$root.message('info', 'Hero is currently in queue.');
                this.$http.patch('/api/heroes/' + this.state.id).then(function (result) {
                    this.state = result.data;
                    this.$root.message('success', 'Hero updated', 2000);
                }.bind(this), function (response) {
                    this.$root.message('warning', response.data);
                }.bind(this));
            }
        }
    }
</script>