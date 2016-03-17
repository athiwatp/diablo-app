<template>
	<div id="app">
		<main-header>
			<banner :parameters="topBannerParameters"
                    class="banner--slim"
                    id="top-banner"
            >
                <h1>Seasonal Leaderboards</h1>
            </banner>
		</main-header>

		<main-content>
		</main-content>
	</div>
</template>

<script>
	export default {
        data () {
            return {
                topBannerParameters: {
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed 50% 0'
                }
            }
        },
        
		props: ['data']
	}
</script>