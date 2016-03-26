<template>
    <section class="leaderboard-rankings">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <h2 class="section-header section-header--left">Softcore</h2>
                    <ul class="list">
                        <component :is="component_header"></component>
                        <component v-for="(index, ranking) in state.softcore"
                                   :ranking="ranking"
                                   :index="index | rank"
                                   :is="component"
                        ></component>
                    </ul>
                    <div class="text-xs-center">
                        <a :href="state.softcore_show_all"
                           class="btn btn--secondary btn--icon"
                        >
                            Show All <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <h2 class="section-header section-header--right">Hardcore</h2>
                    <ul class="list">
                        <component :is="component_header"></component>
                        <component v-for="(index, ranking) in state.hardcore"
                                   :ranking="ranking"
                                   :index="index | rank"
                                   :is="component"
                        ></component>
                    </ul>
                    <div class="text-xs-center">
                        <a :href="state.hardcore_show_all"
                           class="btn btn--secondary btn--icon"
                        >
                            Show All <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import rankingItem from '../../components/list/ranking-item.vue';
    import rankingItemHeader from '../../components/list/ranking-item-header.vue';
    import teamRankingItem from '../../components/list/team-ranking-item.vue';
    import teamRankingItemHeader from '../../components/list/team-ranking-item-header.vue';

    export default {
        data () {
            return {
                component: '',
                component_header: ''
            }
        },

        filters: {
            rank (index) {
                var page = this.state.current_page || 1;
                return index + 1 + ((page - 1) * 25);
            }
        },

        props: ['state', 'rank_type'],

        components: {
            rankingItem,
            rankingItemHeader,
            teamRankingItem,
            teamRankingItemHeader
        },

        ready () {
            this.init();
        },

        methods: {
            init () {
                this.component = this.rank_type == 'solo'
                        ? 'ranking-item'
                        : 'team-ranking-item';

                this.component_header = this.rank_type == 'solo'
                        ? 'ranking-item-header'
                        : 'team-ranking-item-header';
            }
        }
    }
</script>