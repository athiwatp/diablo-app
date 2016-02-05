<template>
    <div id="app">
        <component :is="page"></component>
    </div>
</template>
<script>
    import heroesPage from './pages/heroes/heroes.vue';
    import homePage from './pages/home/home.vue';
    import profilePage from './pages/profile/profile.vue';

    export default {
        el: '#app',

        props: ['page'],

        components: {
            homePage,
            profilePage,
            heroesPage
        }
    }
</script>