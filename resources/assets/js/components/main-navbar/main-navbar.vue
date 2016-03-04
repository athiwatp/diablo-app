<style lang="scss">
    @import './main-navbar';
</style>

<template>
    <nav class="nav">
        <div class="nav__container container">
            <a href="/"
               class="nav__logo"
            >
                <img :src="logo"
                 alt="logo"
                 class="nav__logo__img">
                 <span class="nav__logo__text"><span class="text--secondary">Diablo</span> Rankings</span>
            </a>
            <ul class="nav__items">
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
                    <a href="/profiles" class="nav__link">
                        Heroes
                        <span class="nav__link__subtext">sanctuary</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
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
                active: ''
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
        }
    }
</script>