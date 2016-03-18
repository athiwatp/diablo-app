<template>
	<li class="list__item list__item--link"
        :class="{ 'list__item--active': ranking['show'] }"
        @click="toggle(ranking, $event)"
    >
        <span class="flex-10">{{ index }}</span>
        <span class="flex-20">{{ ranking.rift_level }}</span>
        <span class="flex-30 hidden-sm-down">
            <img :src="ranking.heroes[0] | classPortrait"
                 alt="portrait"
                 class="class-portrait"
            >
            <span class="text--{{ ranking.heroes[0].class }}">
                {{ ranking.heroes[0].class | capitalize }}
            </span>
        </span>
        <span class="flex-40">
            {{ ranking.profiles[0].battle_tag | battleTag }} {{ ranking.heroes[0].clan_tag ? '&lt;' + ranking.heroes[0].clan_tag + '&gt;' : '' }}
            <i class="fa fa-caret-left pull-xs-right"></i>
        </span>
    </li>
    <div class="row"
         v-show="ranking.show"
    >
        <div class="col-sm-5 col-md-5 text-xs-center hidden-xs-down">
            <img :src="ranking.heroes[0].class | classCrest"
                 alt="portrait"
                 class="img-fluid img-fluid--fix"
            >
        </div>
        <div class="col-sm-7 col-md-7">
            <ul class="list">
                <a href="/profiles/{{ ranking.profiles[0].id }}"
                   class="list__item list__item--link"
                >
                    <span class="flex-50">Profile</span>
                    <span class="flex flex-50">
                        {{ ranking.profiles[0].battle_tag }}
                        <span class="list__item--link__arrow">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </span>
                </a>
                <li class="list__item">
                    <span class="flex-50">Region</span>
                    <span class="flex-50">{{ ranking.region }}</span>
                </li>
                <li class="list__item">
                    <span class="flex-50">Clan</span>
                    <span class="flex-50">{{ ranking.heroes[0].clan_name }}</span>
                </li>
            </ul>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="list__item__footer">
                <a href="/heroes/{{ ranking.heroes[0].id }}"
                   class="btn btn--secondary btn--icon"
                >
                    Go to Hero Page <i class="fa fa-angle-double-right"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		props: ['ranking', 'index'],

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