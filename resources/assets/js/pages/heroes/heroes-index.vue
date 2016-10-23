<style lang="scss" rel="stylesheet/scss">
    @import '../../../sass/mixins';

    .hero-statistics-section {
        min-height: calc(100vh - 49rem);

        @include e('info') {
            display: flex;
            min-height: 300px;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 5rem 0;
        }
    }
</style>

<template>
    <div id="page"
         class="hero-page"
    >
        <main-header>
            <banner :parameters.once="topBannerParameters"
                    id="top-banner"
                    class="banner--slim"
                >
            </banner>
        </main-header>

        <main-content>
            <h2 class="section-header">Statistics</h2>
            <section class="hero-statistics-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 hero-statistics-section__info"
                        >
                            <h1>
                                <i class="fa fa-pie-chart"></i>
                                Heroes
                            </h1>
                            <h6>Find a hero by searching for a profile</h6>
                        </div>
                    </div>
                </div>
            </section>
        </main-content>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                state: [],
                topBannerParameters: {
                    background: 'url("/img/profile-banner.jpg") no-repeat fixed 50% 0'
                }
            }
        },

        props: ['data'],

        ready () {
            this.init();
        },

        methods: {
            init () {
                //
            }
        }
    }
</script>