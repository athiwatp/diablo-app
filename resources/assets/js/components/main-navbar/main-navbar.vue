<style lang="scss">
    @import './main-navbar';
</style>

<template>
    <nav class="nav">
        <div class="nav__container container">
            <img :src="logo"
                 alt="logo"
                 class="nav__logo">
            <ul class="nav__items">
                <li class="nav__item">
                    <a href="/leaderboards" class="nav__link">
                        Leaderboards
                        <span class="nav__link__subtext">rankings</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="/profiles" class="nav__link">
                        Profiles
                        <span class="nav__link__subtext">battlenet</span>
                    </a>
                </li>
                <li class="nav__item">
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
        computed: {
            logo () {
                return BASE_URL + '/img/diablorankings.png'
            }
        }
    }
</script>