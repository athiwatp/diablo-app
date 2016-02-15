<style lang="scss">
    @import '../../../../../sass/variables';
    @import '../../../../../sass/mixins';

    .class-portrait {
        border-radius: 50%;
        border: 1px solid #7e7e7e;
    }
    .caret {
        display: inline-block;
        width: 0px;
        height: 0px;
        margin-left: 2px;
        vertical-align: middle;
        border-top: 4px dashed;
        border-right: 4px solid transparent;
        border-left: 4px solid transparent;
        margin-top: 10px;
    }
</style>

<template>
    <ul class="list-group list-group-flush list-group-ranking">
        <div v-for="(index, ranking) in leaderboard.ladder">
            <li class="list-group-item list-group-ranking__item"
                @click="ranking.show = !ranking.show"
            >
                <span class="list-group-ranking__rank">{{ index + 1 }}</span>
                <span class="list-group-ranking__rift">{{ ranking.rift_level }}</span>
                <span class="list-group-ranking__class hidden-sm-down"> 
                    <img :src="ranking | classPortrait"
                         alt=""
                         class="class-portrait"
                    >
                    {{ ranking.class | capitalize }}
                </span>
                <span class="list-group-ranking__hero">
                    {{ ranking.profile.battle_tag | battleTag }} {{ ranking.hero.clan_tag ? '&lt;' + ranking.hero.clan_tag + '&gt;' : '' }}
                    <i class="caret pull-xs-right"></i>
                </span>
            </li>
            <div class="list-group-ranking__info row"
                 v-show="ranking.show"
                 transition="expand"
            >
                <div class="col-md-5 text-xs-center">
                    <img :src="ranking.class | topImage" alt="" class="img-fluid">
                </div>
                <div class="col-md-7">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-ranking__info__item">
                            <span class="list-group-ranking__info__left">Profile</span>
                            <span class="list-group-ranking__info__right">{{ ranking.profile.battle_tag }}</span>
                        </li>
                        <li class="list-group-item list-group-ranking__info__item">
                            <span class="list-group-ranking__info__left">Region</span>
                            <span class="list-group-ranking__info__right">{{ ranking.region }}</span>
                        </li>
                        <li class="list-group-item list-group-ranking__info__item">
                            <span class="list-group-ranking__info__left">Clan</span>
                            <span class="list-group-ranking__info__right">{{ ranking.hero.clan_name }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 text-xs-right">
                    <a  href="/heroes/{{ ranking.hero.id }}"
                        class="btn btn--secondary">Go to Hero Page</a>
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