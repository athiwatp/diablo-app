<template>
    <div id="app">
        <component :is="page">
            <slot></slot>
        </component>
    </div>
</template>
<script>
    import errorPage from './pages/error/error.vue';
    import heroesPage from './pages/heroes/heroes.vue';
    import homePage from './pages/home/home.vue';
    import profilePage from './pages/profile/profile.vue';

    export default {
        el: '#app',

        props: ['page'],

        components: {
            errorPage,
            heroesPage,
            homePage,
            profilePage
        }
    }
</script>