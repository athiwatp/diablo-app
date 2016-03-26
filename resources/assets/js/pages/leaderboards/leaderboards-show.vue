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
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12"
                         v-if="state.heroes.length > 0"
                    >
                        <ul class="list">
                            <list-item-header></list-item-header>
                            <list-item v-for="hero in state.heroes"
                                       :hero="hero"
                                       v-for="hero in state.heroes"
                                       stagger="100"
                            ></list-item>
                        </ul>
                    </div>
                </div>
            </section>
		</main-content>
	</div>
</template>

<script>
    import listItem from '../../components/list/list-item.vue';
    import listItemHeader from '../../components/list/list-item-header.vue';
    import leaderboardsShowStub from '../../stubs/leaderboards-show.js'
    
	export default {
        data () {
            return leaderboardsShowStub
        },

        ready () {
            this.init();
        },

        props: ['data'],

        components: {
            listItem,
            listItemHeader
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            }
        }
	}
</script>