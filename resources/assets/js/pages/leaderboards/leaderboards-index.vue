<style lang="scss" rel="stylesheet/scss">
    .class-list {
        width: 100%;
        background-color: rgba(0, 0, 0, 0.2);
        transition: .3s ease;
        height: 48px;
        text-align: center;
        color: #fff !important;
        text-transform: capitalize;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 1;
        text-decoration: none !important;
    }
</style>

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
            <h2 class="section-header">Filter</h2>
            <section class="leaderboards-filter">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-xs-center m-t-1 m-b-3">
                            <h1>
                                <i class="fa fa-filter"></i>
                                Filters
                            </h1>
                            <h6>Coming Soon</h6>
                        </div>
                    </div>
                </div>
            </section>
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
                    background: 'url("/img/leaderboards-banner.jpg") no-repeat fixed 50% 0'
                },
                classes: [
                    { class: 'barbarian', selected: false },
                    { class: 'crusader', selected: false },
                    { class: 'demon-hunter', selected: false},
                    { class: 'monk', selected: false },
                    { class: 'witch-doctor', selected: false },
                    { class: 'wizard', selected: false },
                ],
                teams: [
                    { team: 2, selected: false },
                    { team: 3, selected: false },
                    { team: 4, selected: false }
                ],
                type: '',
                types: ['softcore', 'hardcore'],
                mode: '',
                modes: ['season', 'era'],
                period: '',
                periods: [5],
                region: '',
                regions: ['world', 'americas', 'europe', 'korea', 'taiwan']
            }
        },

        components: {
            classSection,
            teamSection
        }
    }
</script>