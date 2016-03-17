<template>
    <div id="app">
        <component :is="page" 
                   :data="data"
        >
            <slot></slot>
        </component>
    </div>
</template>

<script>
    import errorPage from './pages/error/error.vue';
    import heroesIndexPage from './pages/heroes/heroes-index.vue';
    import heroesShowPage from './pages/heroes/heroes-show.vue';
    import homePage from './pages/home/home.vue';
    import profileIndexPage from './pages/profile/profile-index.vue';
    import profileShowPage from './pages/profile/profile-show.vue';
    import leaderboardsIndexPage from './pages/leaderboards/leaderboards-index.vue';
    import leaderboardsShowPage from './pages/leaderboards/leaderboards-show.vue';
    import leaderboardsSeasonShowPage from './pages/leaderboards/season-show.vue';
    import leaderboardsClassIndexPage from './pages/leaderboards/class-index.vue';
    import leaderboardsClassShowPage from './pages/leaderboards/class-show.vue';
    import leaderboardsTeamIndexPage from './pages/leaderboards/team-index.vue';
    import leaderboardsTeamShowPage from './pages/leaderboards/team-show.vue';

    export default {
        el: '#app',

        props: ['data', 'page', 'menu'],

        components: {
            errorPage,
            heroesIndexPage,
            heroesShowPage,
            homePage,
            profileIndexPage,
            profileShowPage,
            leaderboardsIndexPage,
            leaderboardsShowPage,
            leaderboardsClassIndexPage,
            leaderboardsClassShowPage,
            leaderboardsTeamIndexPage,
            leaderboardsTeamShowPage,
            leaderboardsSeasonShowPage
        },

        ready () {
            this.$broadcast('menu:active', this.menu);
        },

        methods: {
            message (type, message, duration) {
                this.$broadcast('message:show', type, message, duration);
            }
        }
    }
</script>