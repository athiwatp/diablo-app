<template>
    <section class="leaderboard-rankings">
        <h2 class="section-header">Rankings</h2>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ul class="list">
                        <component :is="component_header"></component>
                        <component v-for="(index, ranking) in state.data"
                                   :ranking="ranking"
                                   :index="index | rank"
                                   :is="component"
                        ></component>
                    </ul>
                    <div class="flex">
                        <div class="flex-50">
                            <a :href="state.prev_page_url"
                               class="btn btn--secondary btn--icon-left"
                               v-if="state.prev_page_url"
                            >
                                <i class="fa fa-angle-left"></i> Prev
                            </a>
                        </div>
                        <div class="flex-50 text-xs-right">
                            <a :href="state.next_page_url"
                               class="btn btn--secondary"
                               v-if="state.next_page_url"
                            >
                                Next <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
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
                return index + 1 + ((this.state.current_page - 1) * 25);
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