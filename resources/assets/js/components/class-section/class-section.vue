<template>
	<h2 class="section-header">Classes</h2>
    <section class="leaderboard-classes">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-12"
                     v-for="class in classes"
                >
                    <a :href="class | leaderboardClassLink"
                       class="leaderboard-classes__class"
                    >
                        <img :src="class | classPreview">
                        <span class="leaderboard-classes__class__sub-text">
                            {{ class }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
	export default {
		data () {
			return {
				classes: [
                    'barbarian', 'crusader', 'demon-hunter', 'monk', 'witch-doctor', 'wizard'
                ]
			}
		},

		filters: {
			leaderboardClassLink (c) {
                return '/leaderboards/season/' + CURRENT_SEASON + '/class/' + c.replace('-', '');
            }
		}
	}
</script>