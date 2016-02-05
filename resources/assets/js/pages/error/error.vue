<style lang="scss">
    //
</style>

<template>
    <div id="app">
        <header>
            <main-navbar></main-navbar>
            <jumbo>{{ statusCode }}</jumbo>
        </header>
        
        <main-footer></main-footer>
    </div>
</template>

<script>
    import mainNavbar from '../../components/main-navbar/app.vue';
    import mainFooter from '../../components/main-footer/app.vue';
    import jumbo from '../../components/jumbotron/app.vue';

    export default {
        props: ['statusCode'],

        data () {
            return {
                //
            }
        },

        components: { mainNavbar, mainFooter, jumbo },

        computed: {
            //
        },

        ready () {
            //
        },

        methods: {
            //
        }
    }
</script>