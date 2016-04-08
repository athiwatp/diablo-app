<style lang="scss" rel="stylesheet/scss">
    @import '../../../sass/variables';
    @import '../../../sass/mixins';

    hr {
        width: 80%;
        margin: 0 auto;
    }

    .filter {
        @include e('container') {
            opacity: .1;
            pointer-events: none;
            transition: $transition;
            margin: 1rem auto;

            @include m('active') {
                opacity: 1;
                pointer-events: all;
            }
        }

        @include e('header') {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        @include e('row') {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2rem auto;
        }

        @include e('list') {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;

            @media screen and (max-width: 768px) {
                flex-direction: column;

                .filter__item {
                    margin-left: 0 !important;
                    margin-bottom: .5rem;
                    width: 100%;
                    flex-basis: 0;
                }
            }
        }

        @include e('submit') {
            margin-top: 8rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        @include e('item') {
            background-color: rgba(0, 0, 0, 0.2);
            height: 48px;
            text-align: center;
            color: #fff !important;
            text-transform: capitalize;
            opacity: 1;
            text-decoration: none !important;
            position: relative;
            transition: $transition;
            padding: 2rem;
            display: flex;
            flex-basis: 200px;
            justify-content: center;
            align-items: center;

            &:not(:first-child) {
                margin-left: 15px;
            }

            &:after {
                content: "";
                width: 100%;
                position: absolute;
                bottom: 0px;
                left: 0;
                height: 0px;
                background: rgba($secondary-color, .4);
                z-index: 999999999999;
                display: inline-block;
                transition: $transition;
                opacity: 1;
            }

            &:hover {
                background-color: rgba(0, 0, 0, .1);
                cursor: pointer;
            }

            @include m('selected') {
                transition: $transition;

                &:after {
                    height: 10%;
                }
            }
        }
    }
</style>

<template>
    <div id="page">
        <main-header>
            <banner :parameters="topBannerParameters"
                    class="banner--slim"
                    id="top-banner"
            >
                <h1>Seasonal Leaderboards</h1>
            </banner>
        </main-header>

        <main-content>
            <h2 class="section-header">Leaderboards Filter</h2>
            <section class="filter">
                <div class="filter__header">
                    <h1>
                        <i class="fa fa-filter"></i>
                        Filters
                    </h1>
                    <h6>Select a Class or Team to begin</h6>
                </div>
                <div class="filter__row">
                    <div class="filter__list">
                        <span class="filter__item"
                              :class="{
                                'filter__item--selected': class.selected
                              }"
                              @click="selectClass(class)"
                              v-for="class in classes"
                        >
                            {{ class.class | capitalize }}
                        </span>
                    </div>
                </div>
                <div class="filter__header">
                    <h4>- or - </h4>
                </div>
                <div class="filter__row">
                    <div class="filter__list">
                        <span class="filter__item"
                              :class="{
                                'filter__item--selected': team == t
                              }"
                              @click="selectTeam(t)"
                              v-for="t in teams"
                        >
                            {{ t }} Players
                        </span>
                    </div>
                </div>
                <hr>
                <div class="filter__container"
                     :class="{
                        'filter__container--active': stage > 0
                     }"
                >
                    <div class="filter__header">
                        <h4>Mode</h4>
                    </div>
                    <div class="filter__row">
                        <div class="filter__list">
                        <span class="filter__item"
                              @click="mode = m"
                              :class="{
                                'filter__item--selected': mode == m
                              }"
                              v-for="m in modes"
                        >
                            {{ m }}
                        </span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__container"
                     :class="{
                        'filter__container--active': stage > 1
                     }"
                >
                    <div class="filter__header">
                        <h4>Period</h4>
                    </div>
                    <div class="filter__row">
                        <div class="filter__list">
                        <span class="filter__item"
                              :class="{
                                'filter__item--selected': period === p
                              }"
                              @click="period = p"
                              v-for="p in periods"
                        >
                            {{ p }}
                        </span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__container"
                     :class="{
                        'filter__container--active': stage > 2
                     }"
                >
                    <div class="filter__header">
                        <h4>Type</h4>
                    </div>
                    <div class="filter__row">
                        <div class="filter__list">
                        <span class="filter__item"
                              :class="{
                                'filter__item--selected': type == t
                              }"
                              @click="type = t"
                              v-for="t in types"
                        >
                            {{ t }}
                        </span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__container"
                     :class="{
                        'filter__container--active': stage > 3
                     }"
                >
                    <div class="filter__header">
                        <h4>Region</h4>
                    </div>
                    <div class="filter__row">
                        <div class="filter__list">
                        <span class="filter__item"
                              :class="{
                                'filter__item--selected': r.selected
                              }"
                              @click="selectRegion(r)"
                              v-for="r in regions"
                        >
                            {{ r.region | capitalize }}
                        </span>
                        </div>
                    </div>
                </div>
                <div class="filter__submit">
                    <button class="btn btn--secondary btn-lg"
                            :disabled="stage !== 5"
                            @click="filter"
                    >
                        Submit
                    </button>
                </div>
            </section>
        </main-content>
    </div>
</template>

<script>
    import classSection from '../../components/class-section/class-section.vue';
    import teamSection from '../../components/team-section/team-section.vue';

    export default {
        data () {
            return {
                topBannerParameters: {
                    background: 'url("/img/leaderboards-banner.jpg") no-repeat fixed 50% 0'
                },
                classes: [
                    {class: 'barbarian', selected: false},
                    {class: 'crusader', selected: false},
                    {class: 'demon-hunter', selected: false},
                    {class: 'monk', selected: false},
                    {class: 'witch-doctor', selected: false},
                    {class: 'wizard', selected: false},
                ],
                teams: [2, 3, 4],
                team: 0,
                type: '',
                types: ['softcore', 'hardcore'],
                mode: '',
                modes: ['season', 'era'],
                period: '',
                periods: [1, 2, 3, 4, 5],
                regions: [
                    {region: 'world', selected: false},
                    {region: 'americas', abbr: 'us', selected: false},
                    {region: 'europe', abbr: 'eu', selected: false},
                    {region: 'korea', abbr: 'kr', selected: false},
                    {region: 'taiwan', abbr: 'tw', selected: false}
                ]
            }
        },

        components: {
            classSection,
            teamSection
        },

        computed: {
            stage () {
                var stage = 0;

                var c = this.classes.filter(function (i) {
                    return i.selected;
                });

                if (c.length > 0 || this.team > 0) {
                    stage++;
                }

                if (this.mode !== '') {
                    stage++;
                }

                if (this.period !== '') {
                    stage++;
                }

                if (this.type !== '') {
                    stage++;
                }

                var r = this.regions.filter(function (i) {
                    return i.selected;
                });

                if (r.length > 0) {
                    stage++;
                }

                return stage;
            }
        },

        methods: {
            selectClass (c) {
                c.selected = !c.selected;

                this.team = 0;
            },

            selectTeam (t) {
                this.team = t;

                this.classes.map(function (i) {
                    i.selected = false;

                    return i;
                });
            },

            selectRegion (r) {
                r.selected = !r.selected;

                if (r.region === 'world') {
                    this.regions.map(function (i) {
                        if (i.region !== 'world') {
                            i.selected = false;
                        }

                        return i;
                    })
                } else {
                    this.regions.map(function (i) {
                        if (i.region === 'world') {
                            i.selected = false;
                        }

                        return i;
                    });
                }
            },

            filter () {
                var season = this.mode === 'season'
                        ? 1
                        : 0;

                var teamClass = '';
                var region = '';

                var c = this.classes.filter(function (i) {
                    return i.selected;
                });

                var r = this.regions.filter(function (i) {
                    return i.selected;
                });

                var t = this.teams.filter(function (i) {
                    return i.selected;
                });

                if (c.length > 0) {
                    teamClass = '&class[]=' + c.map(function (i) {
                                return i.class;
                            }).join('&class[]=');
                } else {
                    teamClass = '&players=' + this.team;
                }

                if (r[0].region !== 'world') {
                    region = '&region[]=' + r.map(function (i) {
                                return i.abbr;
                            }).join('&region[]=');
                }

                window.open(BASE_URL + '/leaderboards/filter/preview?season=' + season + '&period=' + this.period + teamClass + region);
            }
        }
    }
</script>