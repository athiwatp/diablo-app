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
                 <span class="nav__logo__text">Diablo Rankings</span>
            </a>
            <ul class="nav__items">
                <li class="nav__item"
                    :class="{ 'nav__item--active': isActive('leaderboardPage') }"
                >
                    <a href="/leaderboards" 
                       class="nav__link"
                    >
                        Leaderboards
                        <span class="nav__link__subtext">rankings</span>
                    </a>
                </li>
                <li class="nav__item"
                    :class="{ 'nav__item--active': isActive('profilePage') }"
                >
                    <a href="/profiles" class="nav__link">
                        Profiles
                        <span class="nav__link__subtext">battlenet</span>
                    </a>
                </li>
                <li class="nav__item"
                    :class="{ 'nav__item--active': isActive('heroPage') }"
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
        props: ['page'],

        computed: {
            logo () {
                return BASE_URL + '/img/diablorankings.png'
            }
        },

        methods: {
            isActive (page) {
                return this.page == page;
            }
        }
    }
</script>