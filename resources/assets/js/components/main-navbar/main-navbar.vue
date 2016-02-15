<style lang="scss">
    @import './_main-navbar.scss';
</style>

<template>
    <nav class="navbar navbar-light bg-faded navbar-full navbar--diablo">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img :src="logo" alt="">
            </a>
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
            </ul>
        </div>
    </nav>
</template>

<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('nav').addClass('navbar--scroll');
        } else {
            $('nav').removeClass('navbar--scroll');
        }
    })
    export default {
        computed: {
            logo () {
                return BASE_URL + '/img/diablorankings.png'
            }
        }
    }
</script>