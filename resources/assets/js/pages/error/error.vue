<style lang="scss">
    //
</style>

<template>
    <div id="app">
        <header>
            <main-navbar></main-navbar>
        </header>
        
        <main-footer></main-footer>
    </div>
</template>

<script>
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';

    export default {
        data () {
            return {
                //
            }
        },

        components: { mainNavbar, mainFooter },

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