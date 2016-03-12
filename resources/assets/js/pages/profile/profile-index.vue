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
                        <div class="col-md-6 col-md-offset-3">
                            <form method="GET" action="/profiles">
                                <div class="input-group p-t-2 p-b-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button class="btn btn--secondary m-b-0" type="submit"><i class="fa fa-search"></i> Search</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <ul class="list m-b-1">
                                <a class="list__item list__item--link"
                                   v-for="profile in state"
                                   href="/profiles/{{ profile.id }}"
                                >
                                    {{ profile.battle_tag }}
                                </a>
                            </ul>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-xs-center p-b-3"
                             v-if="!data"
                        >
                            <h1>
                                <i class="fa fa-info-circle"></i>
                                Profile Search
                            </h1>
                            <h6>Enter the players Battle Tag #</h6>
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