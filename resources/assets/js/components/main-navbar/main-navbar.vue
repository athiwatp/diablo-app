<style lang="scss">
    @import './_main-navbar.scss';
</style>

<template>
    <nav class="navbar navbar-light bg-faded navbar-full navbar--diablo">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img :src="logo" alt="">
                <span class="navbar-brand__text">
                    D<span class="navbar-brand__subtext">iablo</span>
                    R<span class="navbar-brand__subtext">ankings</span>
                </span>
            </a>
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/leaderboards" class="nav-link">Leaderboards</a>
                </li>
                <li class="nav-item">
                    <a href="/profiles" class="nav-link">Profiles</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        computed: {
            logo () {
                return BASE_URL + '/img/diablorankings.png'
            }
        }
    }
</script>