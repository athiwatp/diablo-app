<style lang="scss">
    //
</style>

<template>
    <div id="app">
        <header>
            <main-navbar></main-navbar>
            <jumbo>
                <slot></slot>
            </jumbo>
        </header>
        
        <main-footer></main-footer>
    </div>
</template>

<script>
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';
    import jumbo from '../../components/jumbotron/jumbo.vue';

    export default {
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