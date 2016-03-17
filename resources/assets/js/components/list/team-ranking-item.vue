<template>
	<li class="list__item list__item--link"
       @click="toggle(ranking, $event)"
    >
        <span class="flex-10">{{ ranking.rank }}</span>
        <span class="flex-20">{{ ranking.rift_level }}</span>
        <span class="flex-10">{{ ranking.region }}</span>
        <span class="flex-30 text-xs-center">
            <template v-for="class in ranking.class_portraits.split(',')">
                <img :src="class | classPortrait"
                     alt="portrait"
                     class="class-portrait"
                >
            </template>
        </span>
        <span class="flex-30 text-xs-center">
            <i class="fa fa-clock-o"></i>
            {{ ranking.rift_time | time }}
            <i class="fa fa-caret-left pull-xs-right"></i>
        </span>
    </li>
    <div class="row"
         v-show="ranking.show"
    >
        <div class="col-sm-12 col-md-12 text-xs-center hidden-xs-down flex">
            <div v-for="class in ranking.classes.split(',')"
                 :class="{
                    'flex-30': ranking.players == 2,
                    'flex-20': ranking.players == 3,
                    'flex-15': ranking.players == 4,
                 }"
            >
                <img :src="class | classCrest"
                     alt="portrait"
                     class="img-fluid img-fluid--fix"
                     style="margin: 0 auto; opacity: .6"
                >
            </div>
        </div>
        <div class="col-sm-12 col-md-12 m-t-2">
            <div class="list__item__footer">
                <a href="/leaderboards/{{ ranking.leaderboard_ids }}"
                   class="btn btn--secondary btn--icon"
                >
                    Go to Leaderboard Page <i class="fa fa-angle-double-right"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		props: ['ranking', 'index'],

        filters: {
            flexLength (hero) {
                if (typeof hero.heroes == 'undefined') {
                    return;
                }

                var length = hero.heroes.length;

                switch (length) {
                    case 2:
                        return 'flex-30';
                    break;
                    case 3:
                        return 'flex-20';
                    break;
                    case 4:
                        return 'flex-15';
                    break;
                }
            }
        },

		methods: {
            toggle (ranking, e) {
                var $el = $(e.target);


                if (!$el.hasClass('list__item')) {
                    $el = $el.closest('.list__item');
                }

                $el.toggleClass('list__item--active').next().slideToggle(300, function () {
                    ranking.show = !ranking.show;
                });
            }
        }
	}
</script>