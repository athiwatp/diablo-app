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
            <h2 class="section-header">Leaderboard Ranking</h2>
            <section class="leaderboard-class">
                <div class="row">
                    <div class="col-sm-12 col-md-12 text-xs-center hidden-xs-down flex">
                        <div v-for="hero in state.heroes"
                             :class="{
                                'flex-100': state.players == 1,
                                'flex-30': state.players == 2,
                                'flex-20': state.players == 3,
                                'flex-15': state.players == 4,
                             }"
                        >
                            <img :src="hero.class | classCrest"
                                 alt="portrait"
                                 class="img-fluid img-fluid--fix"
                                 style="margin: 0 auto; opacity: .6"
                            >
                        </div>
                    </div>
                </div>
            </section>
            <section class="leaderboard-statistics m-t-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <div class="block__body">
                                <div class="block__row">
                                    <div class="row">
                                        <div class="col-md-3 block__col">
                                            <h5 class="block__header"><i class="fa fa-level-up"></i> Rift Level</h5>
                                            <h3 class="text--secondary block__col__header divider">
                                                {{ state.rift_level }}
                                            </h3>
                                        </div>
                                        <div class="col-md-3 block__col">
                                            <h5 class="block__header"><i class="fa fa-clock-o"></i> Rift Time</h5>
                                            <h3 class="text--tertiary block__col__header divider">
                                                {{ state.rift_time | time }}
                                            </h3>
                                        </div>
                                        <div class="col-md-3 block__col">
                                            <h5 class="block__header"><i class="fa fa-globe"></i> Region</h5>
                                            <h3 class="text--quaternary block__col__header divider">
                                                {{ state.region }}
                                            </h3>
                                        </div>
                                        <div class="col-md-3 block__col">
                                            <h5 class="block__header"><i class="fa fa-users"></i> Players</h5>
                                            <h3 class="text--quinary block__col__header">
                                                {{ state.players }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="leaderboard-heroes m-t-3">

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
            </section>
		</main-content>
	</div>
</template>

<script>
	export default {
        data () {
            return {
                state: {
                    heroes: []
                },

                topBannerParameters: {
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed 50% 0'
                }
            }
        },

        ready () {
            this.init();
        },

        props: ['data'],

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            }
        }
	}
</script>