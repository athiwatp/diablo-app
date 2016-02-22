<style>
    .profile-page .banner {
        height: 450px;
    }

    .content {
        margin-top: 0.5rem;
    }

    .profile-section {
        padding: 0 1rem;
    }
</style>
<template>
    <div id="page"
         class="profile-page"
    >

        <main-navbar :page="page"></main-navbar>

        <banner :parameters.once="topBannerParameters">
            <div>
                <h1>{{ state.battle_tag }}</h1>
                <h6>{{ state.region | region}}</h6>
            </div>
        </banner>

        <div class="content">
            <h2 class="section-header">Profile</h2>
            <section class="profile-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="block">
                                <div class="block__body">
                                    <a href="#">Battle.net</a>
                                    <p>
                                        <small>Last Updated: {{ state.updated_at }}</small>
                                    </p>
                                    <button class="btn btn--secondary btn-lg"
                                            @click="updateProfile"
                                    >
                                        Update
                                    </button>
                                </div>
                                <div class="block__footer">
                                    <h5 class="block__footer__header">Greater rift</h5>
                                    <ul class="list">
                                        <li class="list__item"
                                            v-for="ranking in state.rift_rankings"
                                        >
                                            <span class="flex-50">{{ ranking.players }} Players</span>
                                            <span class="flex-50">{{ ranking.rift_level }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <ul class="list">
                                <li class="list__item list__item--header">
                                    <span class="flex-30">Name</span>
                                    <span class="flex-30">Class</span>
                                    <span class="flex-20">Paragon Level</span>
                                    <span class="flex-20 text-xs-right">Mode</span>
                                </li>
                                <a class="list__item list__item--link"
                                    v-for="hero in state.heroes"
                                    href="#"
                                >

                                    <span class="flex-30"
                                          v-if="hero.name"
                                    >
                                        {{ hero.name }}
                                    </span>
                                    <span class="flex-30"
                                          v-else
                                    >
                                        <i class="fa fa-check-circle"></i> New Record
                                    </span>
                                    <span class="flex-30">
                                        <img :src="hero | classPortrait"
                                             alt="portrait"
                                             class="class-portrait"
                                        >
                                        {{ hero.class | capitalize }}
                                    </span>
                                    <span class="flex-20">{{ hero.paragon_level }}</span>
                                    <span class="flex-20 text-xs-right">
                                        {{ hero.season ? 'Season' : 'Era'}}
                                    </span>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <main-footer></main-footer>
        </div>
    </div>
</template>
<script>
    import banner from '../../components/banner/banner.vue';
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';

    export default {
        data: function () {
            return {
                state: {
                    heroes: []
                },
                topBannerParameters: {
                    background: 'url("http://html.nkdev.info/youplay/dark/assets/images/banner-blog-bg.jpg") no-repeat fixed',
                    backgroundPosition: '50% 0'
                }
            }
        },

        props: ['data', 'page'],

        components: {banner, mainNavbar, mainFooter},

        ready () {
            this.init();
        },

        methods: {
            init () {
                this.state = JSON.parse(this.data);
            },

            updateProfile () {
                this.state.queued = true;
                profilesStore.update(this.state.id);
            }
        }
    }
</script>