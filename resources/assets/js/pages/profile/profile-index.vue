<template>
    <div id="page"
         class="profile-page"
    >
        <main-header>
            <banner :parameters.once="topBannerParameters"
                    id="top-banner"
                    class="banner--slim"
                >
            </banner>
        </main-header>

        <main-content>
            <h2 class="section-header">Find a Profile</h2>
            <section class="profile-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button class="btn btn--secondary m-b-0" type="submit"><i class="fa fa-search"></i> Search</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-xs-center p-t-3 p-b-3">
                            <h1>
                                <i class="fa fa-info"></i>
                                Profile Search
                            </h1>
                            <h6>Enter the profiles Battle Tag #</h6>
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
//                this.state = JSON.parse(this.data);
            }
        }
    }
</script>