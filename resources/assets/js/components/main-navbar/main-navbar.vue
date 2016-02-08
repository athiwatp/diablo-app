<style lang="scss">
    @import './_main-navbar.scss';
</style>

<template>
    <nav class="navbar navbar-light bg-faded navbar-full navbar--diablo">
        <a href="/" class="navbar-brand">
            <img :src="logo" alt="">
        </a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="/leaderboards" class="nav-link">Leaderboards</a>
            </li>
        </ul>
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