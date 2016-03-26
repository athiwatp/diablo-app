<template>
	<div id="page">
		<main-header>
			<banner :parameters="topBannerParameters"
                    class="banner--slim"
                    id="top-banner"
            >
                <h1>Leaderboards</h1>
            </banner>
		</main-header>
		<main-content>
            <component :is="component"
                       :state="state"
                       :rank_type="rank_type"
            ></component>
		</main-content>
	</div>
</template>

<script>
    import preview from './preview.vue';
    import paginate from './paginate.vue';

	export default {
        data () {
            return {
                state: {},
                component: '',
                rank_type: '',
                topBannerParameters: {
                    background: 'url("/img/leaderboards-banner.jpg") no-repeat fixed 50% 0'
                }
            }
        },

        components: {
            preview,
            paginate
        },

        props: ['data'],

        ready () {
            this.init();
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);
                this.component = typeof this.state.softcore == 'undefined'
                        ? 'paginate'
                        : 'preview';

                if (this.component == 'paginate') {
                    this.rank_type = this.state.data[0].players == 1
                        ? 'solo'
                        : 'team';
                } else {
                    this.rank_type = this.state.softcore[0].players == 1
                        ? 'solo'
                        : 'team';
                }
            }
        }
	}
</script>