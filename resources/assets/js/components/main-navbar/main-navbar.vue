<style lang="scss">
    @import './main-navbar';
</style>

<template>
    <nav class="navbar">
        <div class="container navbar__container">
            <img :src="logo" alt="">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="/leaderboards" class="nav-link">
                        Leaderboards
                        <span class="nav-link__subtext">rankings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profiles" class="nav-link">
                        Profiles
                        <span class="nav-link__subtext">battlenet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profiles" class="nav-link">
                        Heroes
                        <span class="nav-link__subtext">sanctuary</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    window.onscroll = function () {
        if (window.pageYOffset > 100) {
            $('nav').addClass('navbar--scroll');
        } else {
            $('nav').removeClass('navbar--scroll');
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