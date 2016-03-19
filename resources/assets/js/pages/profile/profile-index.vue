<style lang="scss">
    @import "../../../sass/mixins";

    .profile-section {
        @include e('info') {
            min-height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        input {
            padding: .75rem .65rem;
        }
    }
</style>

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
                        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                            <form method="GET" 
                                  action="/profiles"
                                  @submit.prevent="submit($event)"
                            >
                                <div class="input-group p-t-2">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Search"
                                           v-model="search"
                                           v-el:search
                                    >
                                    <span class="input-group-btn">
                                        <button class="btn btn--secondary m-b-0" type="submit">
                                            <i class="fa fa-search"></i> <span class="hidden-xs-down">Search</span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 profile-section__info"
                             v-if="state.length > 0 && !loading"
                             stagger="100"
                        >
                            <ul class="list">
                                <li class="list__item list__item--header text-xs-center">
                                    <span class="flex-50">
                                        Region
                                    </span>
                                    <span class="flex-50">
                                        Battletag
                                    </span>
                                </li>
                                <a class="list__item list__item--link text-xs-center"
                                   v-for="profile in state"
                                   href="/profiles/{{ profile.id }}"
                                >
                                    <span class="flex-50">
                                        {{ profile.region | capitalize }}
                                    </span>
                                    <span class="flex-50">
                                        {{ profile.battle_tag }}
                                    </span>
                                </a>
                            </ul>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 profile-section__info"
                             v-if="welcome || loading || empty"
                        >
                            <h1 v-if="welcome">
                                <i class="fa fa-info-circle"></i>
                                Profile Search
                            </h1>
                            <h6 v-if="welcome">Enter the players Battle Tag #</h6>
                            <bounce v-if="loading"></bounce>
                            <h1 v-if="empty"
                                transition="customFade"
                            >
                                No Results
                            </h1>
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
                search: '',
                welcome: true,
                loading: false,
                empty: false,
                topBannerParameters: {
                    background: 'url("/img/profile-banner.jpg") no-repeat fixed 50% 0'
                }
            }
        },

        transitions: {
            customFade: {
                css: false,

                enter: function (el, done) {
                    $(el).hide()
                        .fadeIn(done);
                },

                enterCancelled: function (el) {
                    $(el).stop();
                },

                leave: function (el, done) {
                    $(el).css('display', 'none');
                    done
                },

                leaveCancelled: function (el) {
                    $(el).stop();
                }
            }
        },

        props: ['data'],

        ready () {
            this.init();
        },

        methods: {
            init () {
                this.$els.search.focus();
                if (this.data.length > 0) {
                    this.state = JSON.parse(this.data);
                    this.welcome = false;
                }
            },

            submit () {
                this.welcome = false;
                this.loading = true;
                this.empty = false;
                this.$http.get(BASE_URL + '/api/profiles/search', {search: this.search}).then(function (response) {
                    this.loading = false;
                    this.state = response.data;

                    if (this.state.length == 0) {
                        this.$nextTick(() => {
                            this.empty = true;
                        });
                    }
                }.bind(this));
            }
        }
    }
</script>