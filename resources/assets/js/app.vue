<style lang="scss">
    @import '../sass/app';
</style>

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
    import heroesPage from './pages/heroes/heroes.vue';
    import homePage from './pages/home/home.vue';
    import profileIndexPage from './pages/profile/profile-index.vue';
    import profileShowPage from './pages/profile/profile-show.vue';
    import leaderboardsIndexPage from './pages/leaderboards/index.vue';
    import leaderboardsClassIndexPage from './pages/leaderboards/class-index.vue';
    import leaderboardsClassShowPage from './pages/leaderboards/class-show.vue';
    import leaderboardsTeamIndexPage from './pages/leaderboards/team-index.vue';
    import leaderboardsTeamShowPage from './pages/leaderboards/team-show.vue';

    export default {
        el: '#app',

        props: ['data', 'page', 'menu'],

        components: {
            errorPage,
            heroesPage,
            homePage,
            profileIndexPage,
            profileShowPage,
            leaderboardsIndexPage,
            leaderboardsClassIndexPage,
            leaderboardsClassShowPage,
            leaderboardsTeamIndexPage,
            leaderboardsTeamShowPage
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