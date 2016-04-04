<template>
	<a class="list__item list__item--link list__item--link--{{ hero.hardcore ? 'hardcore' : 'softcore' }}"
       :href="hero | heroLink"
    >
        <span class="flex-30"
              v-if="hero.name"
        >
            {{ hero.name }}
        </span>
        <span class="flex-30"
              v-else
        >
            <span v-if="hero.class == 'missing'">
                <i class="fa fa-times fa-fw" ></i> Missing Hero Record
            </span>
            <span v-else>
                <i class="fa fa-warning fa-fw"></i> New Hero Record
            </span>
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
        <span class="flex-20">{{ hero.paragon_level || '' }}</span>
        <span class="flex flex-20 text-xs-center">
            {{ hero | modeType }}
            <span class="list__item--link__arrow">
                <i class="fa fa-angle-right"></i>
            </span>
        </span>
    </a>
</template>

<script>
	export default {
		props: ['hero'],

        filters: {
            heroLink (hero) {
                if ('id' in hero) {
                    return '/heroes/' + hero.id;
                }

                return '#!';
            },

            modeType (hero) {
                if ('season' in hero) {
                    return hero.season ? 'Season' : 'Era'
                }

                return '';
            }
        }
	}
</script>