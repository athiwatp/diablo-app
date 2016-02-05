<template>
    <div id="app">
        <component :is="page"></component>
    </div>
</template>
<script>
    import heroesPage from './pages/heroes/app.vue';
    import homePage from './pages/home/app.vue';
    import profilePage from './pages/profile/app.vue';

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