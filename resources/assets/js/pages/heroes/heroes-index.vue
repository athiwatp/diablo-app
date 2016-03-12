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
            <section class="profile-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-xs-center p-t-3 p-b-3"
                        >
                            <h1>
                                <i class="fa fa-pie-chart"></i>
                                Statistics coming soon!
                            </h1>
                            <h6>Top builds, popular items and more is on the way</h6>
                        </div>
                    </div>
                </div>
            </section>
        </main-content>
    </div>
</template>

<script>
    import banner from '../../components/banner/banner.vue';
    import mainHeader from '../../components/main-header/main-header.vue';
    import mainContent from '../../components/main-content/main-content.vue';

    export default {
        data: function () {
            return {
                state: [],
                topBannerParameters: {
                    background: 'url("/img/profile-banner.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                }
            }
        },

        props: ['data'],

        components: {banner, mainHeader, mainContent},

        ready () {
            this.init();
        },

        methods: {
            init () {
                if (this.data.length > 0) {
                    this.state = JSON.parse(this.data);
                }
            }
        }
    }
</script>