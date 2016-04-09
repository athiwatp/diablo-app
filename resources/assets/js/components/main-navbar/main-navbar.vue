<style lang="scss" rel="stylesheet/scss">
    @import './main-navbar';
</style>

<template>
    <div>
        <a href="#!"
           class="fa fa-bars mobile-toggle"
           @click="toggleMobileNav"
           v-if="mobile"
        ></a>
        <nav class="nav"
             :class="{
                'nav--mobile': mobile,
                'nav--mobile--active': showMobileList
             }"
             v-el:nav-bar
        >
            <div class="nav__container container">
                <a href="/"
                   class="nav__logo"
                >
                    <img src="/img/diablorankings.png"
                         alt="logo"
                         class="nav__logo__img">
                    <span class="nav__logo__text"><span class="text--secondary">Diablo</span> Rankings</span>
                </a>
                <ul class="nav__items">
                    <li class="nav__item"
                        :class="{ 'nav__item--active': active == 'homePage' }"
                    >
                        <a href="/"
                           class="nav__link"
                        >
                            Home
                            <span class="nav__link__subtext">diablo</span>
                        </a>
                    </li>
                    <li class="nav__item"
                        :class="{ 'nav__item--active': active == 'leaderboardsPage' }"
                    >
                        <a href="/leaderboards"
                           class="nav__link"
                        >
                            Leaderboards
                            <span class="nav__link__subtext">rankings</span>
                        </a>
                    </li>
                    <li class="nav__item"
                        :class="{ 'nav__item--active': active == 'profilePage' }"
                    >
                        <a href="/profiles" class="nav__link">
                            Profiles
                            <span class="nav__link__subtext">battlenet</span>
                        </a>
                    </li>
                    <li class="nav__item"
                        :class="{ 'nav__item--active': active == 'heroesPage' }"
                    >
                        <a href="/heroes" class="nav__link">
                            Heroes
                            <span class="nav__link__subtext">sanctuary</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    window.onscroll = function () {
        if (window.pageYOffset > 100) {
            $('nav').addClass('nav--scroll');
        } else {
            $('nav').removeClass('nav--scroll');
        }
    };

    export default {
        data () {
            return {
                active: '',
                mobile: false,
                showMobileList: false
            }
        },

        computed: {
            logo () {
                return BASE_URL + '/img/diablorankings.png'
            }
        },

        events: {
            'menu:active' (page) {
                this.active = page;
            }
        },

        ready () {
            if ($(window).width() <= 768) {
                this.showMobileNav();
            }

            $(window).resize(function () {
                if ($(window).width() <= 768) {
                    this.showMobileNav();
                } else {
                    this.hideMobileNav();
                }
            }.bind(this));
        },

        methods: {
            toggleMobileNav () {
                this.showMobileList = !this.showMobileList;
            },

            showMobileNav () {
                $(this.$els.navBar).hide();
                this.mobile = true;
                setTimeout(() => {
                        $(this.$els.navBar).show();
                }, 300);
            },

            hideMobileNav () {
                this.showMobileList = false;
                this.mobile = false;
            }
        }
    }
</script>