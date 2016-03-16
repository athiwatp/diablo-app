<template>
	<li class="list__item list__item--link"
       @click="toggle(ranking, $event)"
    >
        <span class="flex-10">{{ ranking.rank }}</span>
        <span class="flex-20">{{ ranking.rift_level }}</span>
        <span class="flex-10">{{ ranking.region }}</span>
        <span class="flex-60 text-xs-center">
            <template v-for="hero in ranking.heroes">
                <img :src="hero.hero | classPortrait"
                     alt="portrait"
                     class="class-portrait"
                >
            </template>
            <i class="fa fa-caret-left pull-xs-right"></i>
        </span>
    </li>
    <div class="row"
         v-show="ranking.show"
    >
        <div class="col-sm-12 col-md-12 text-xs-center hidden-xs-down flex">
            <div v-for="hero in ranking.heroes"
                 :class="{
                    'flex-30': ranking.heroes.length == 2,
                    'flex-20': ranking.heroes.length == 3,
                    'flex-15': ranking.heroes.length == 4,
                 }"
            >
                <img :src="hero.class | classCrest"
                     alt="portrait"
                     class="img-fluid"
                     style="margin: 0 auto; opacity: .6"
                >
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {{ hero.profile.battle_tag | battleTag }}
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {{ hero.hero.clan_tag ? '&lt;' + hero.hero.clan_tag + '&gt;' : '&nbsp' }}
                    </div>
                </div>
                <div class="block m-t-1">
                    <div class="block__body">
                        <div class="block__row">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 block__col">
                                    <h3 class="text--tertiary block__col__header">{{ hero.hero.paragon_level }}</h3>
                                    <small>paragon</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="list__item__footer">
                <a href=""
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