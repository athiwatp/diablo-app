<style lang="scss">
    @import '../../../../../sass/_variables.scss';

    .class-portrait {
        border-radius: 50%;
        border: 1px solid #7e7e7e;
        background-color: $primary-color;
    }
</style>

<template>
    <div class="card card--diablo text-xs-{{ orientation == 'left' ? 'right' : 'left' }}">
        <img :src="topImage" alt="" class="card-img-top ">

        <div class="card-img-overlay text-xs-{{ orientation }}">
            <h3 class="card-title text-uppercase"><slot></slot></h3>
            <h3 class="text--tertiary">{{ leaderboard.top.rift_level }}</h3>
            <h4 class="text--secondary">{{ leaderboard.top.profile.battle_tag | battleTag }}</h4>
            <h4 class="text--secondary m-b-2">{{ leaderboard.top.hero.clan_tag ? '&lt;' + leaderboard.top.hero.clan_tag + '&gt;' : '&nbsp;' }}</h4>
            <div class="card-text">
                <a href="/heroes/{{ leaderboard.top.hero.id }}" class="btn btn--secondary">Go to Hero</a>
            </div>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item--diablo"
                v-for="ranking in leaderboard.ladder"
            >
                <div class="row">
                    <div class="col-md-2 text-xs-center">
                        <span class="label label--diablo">{{ ranking.rift_level }}</span>
                    </div>
                    <div class="col-md-4 text-md-right text-xs-center">
                        <span :class="ranking.class | classText"
                              class="hidden-md-down"
                        >
                            {{ ranking.class | capitalize }}
                        </span>
                        <img :src="ranking | classPortrait"
                             alt=""
                             class="class-portrait"
                        >
                    </div>
                    <div class="col-md-6 text-md-right text-xs-center">
                        <a href="/heroes/{{ ranking.hero.id }}">
                            {{ ranking.profile.battle_tag | battleTag }}
                        </a>
                        <a href="#">{{ ranking.hero.clan_tag ? '&lt;' + ranking.hero.clan_tag + '&gt;' : '' }}</a>
                    </div>
                </div>
            </li>
            <li class="list-group-item text-xs-center">
                <a href="#" class="btn btn--secondary-outline">View All</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['leaderboard', 'orientation'],

        computed: {
            topImage () {
                if (typeof this.leaderboard.top.class != 'undefined') {
                    return BASE_URL + '/img/' + this.leaderboard.top.class + '/crest.png';
                }
            }
        }
    }
</script>