<style lang="scss">
    @import '../../../../../sass/variables';
    @import '../../../../../sass/mixins';

    .class-portrait {
        border-radius: 50%;
        border: 1px solid #7e7e7e;
    }
</style>

<template>
    <ul class="list-group list-group-flush list-group-ranking">
        <div v-for="(index, ranking) in leaderboard.ladder">
            <li class="list-group-item"
                @click="ranking.show = true"
            >
                <span class="list-group-ranking__rank">{{ index + 1 }}</span>
                <span class="list-group-ranking__rift">{{ ranking.rift_level }}</span>
                <span class="list-group-ranking__class"> 
                    <img :src="ranking | classPortrait"
                         alt=""
                         class="class-portrait"
                    >
                    {{ ranking.class | capitalize }}
                </span>
                <span class="list-group-ranking__hero">
                    {{ ranking.profile.battle_tag | battleTag }} {{ ranking.hero.clan_tag ? '&lt;' + ranking.hero.clan_tag + '&gt;' : '' }}
                </span>
            </li>
            <div class="card card--ranking"
                 v-show="ranking.show"
            >
                <img :src="ranking.class | topImage" alt="" class="card-img-top ">
                <div class="card-img-overlay text-xs-right">
                    here
                </div>
            </div>
        </div>
    </ul>
</template>

<script>
    export default {
        props: ['leaderboard', 'orientation'],

        filters: {
            topImage (value) {
                return BASE_URL + '/img/' + value + '/crest.png';
            }
        }
    }
</script>