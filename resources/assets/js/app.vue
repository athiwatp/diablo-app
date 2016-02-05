<template>
    <div id="app">
        <component :is="page" :status-code="statusCode"></component>
    </div>
</template>
<script>
    import heroesPage from './pages/heroes/heroes.vue';
    import homePage from './pages/home/home.vue';
    import profilePage from './pages/profile/profile.vue';
    import errorPage from './pages/error/error.vue';

    export default {
        el: '#app',

        props: ['page', 'statusCode'],

        components: {
            homePage,
            profilePage,
            heroesPage,
            errorPage
        }
    }
</script>