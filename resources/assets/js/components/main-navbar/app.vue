<style lang="scss">
    @import './_app.scss';
</style>
<template>
    <nav class="navbar navbar-light bg-faded navbar-full navbar--diablo">
        <a href="#" class="navbar-brand">
            <img :src="logo" alt="">
        </a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Leaderboards</a>
            </li>
            <li class="nav-item">
                <a href="/profiles" class="nav-link">Profiles</a>
            </li>
            <li class="nav-item">
                <a href="/heroes" class="nav-link">Heroes</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        computed: {
            logo () {
                return base_url + '/img/diablorankings.png'
            }
        }
    }
</script>