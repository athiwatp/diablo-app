<template>
    <div id="page">
        <main-header>
            <banner :parameters="topBannerParameters"
                    class="banner--slim"
                    id="top-banner"
            >
                <h1>Seasonal Leaderboards</h1>
            </banner>
        </main-header>

        <main-content>
            <class-section></class-section>  
            <team-section></team-section>
        </main-content>
    </div>
</template>

<script>
    import classSection from '../../components/class-section/class-section.vue';
    import teamSection from '../../components/team-section/team-section.vue';

    export default {
        data () {
            return {
                topBannerParameters: {
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed 50% 0'
                }
            }
        },

        components: {
            classSection,
            teamSection
        }
    }
</script>