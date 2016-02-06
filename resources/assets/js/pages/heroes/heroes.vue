<template>
    <div id="page">
        <header>
            <main-navbar></main-navbar>
            <jumbo>{{ state.name }} {{ state.clan_tag ? '&lt;'+state.clan_tag+'&gt;' : '' }}</jumbo>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <note type="success">
                        <i class="material-icons">autorenew</i> Hero is currently in queue.
                    </note>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card--diablo text-xs-center">
                                <img :src="crest" alt="" class="card-img-top img-fluid">

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ state.clan_name || 'No Clan' }}</li>

                                    <li class="list-group-item">{{ state.region }}</li>

                                    <li class="list-group-item">
                                        <a href="#">Battle.net</a>
                                    </li>

                                    <li class="list-group-item">
                                        <p>
                                            <small>Last updated: {{ state.updated_at }}</small>
                                        </p>
                                        <div>
                                            <button class="btn btn--secondary-outline m-t-2"
                                                    @click="update"
                                            >
                                                Update
                                            </button>
                                            <p><small>Currently In Queue</small></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card card--diablo">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <span class="font-weight-bold">Paragon</span>
                                        <span class="pull-xs-right label label--diablo">{{ state.paragon_level }}</span>
                                    </li>
                                    <li class="list-group-item"
                                        v-for="leaderboard in state.leaderboards"
                                    >
                                        <span class="font-weight-bold">{{ leaderboard.players }} Player Rift</span>
                                        <span class="pull-xs-right label label--diablo">{{ leaderboard.rift_level }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card--diablo">
                        <h4 class="card__header-secondary">
                            Gear
                        </h4>
                        <div class="card-body">
                            <div class="row">
                                <div v-for="item in state.items"
                                     class="col-md-4"
                                >
                                    <gear-block :item="item"></gear-block>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-t-3">
                <div class="col-md-4">
                    <div class="card card--diablo">
                        <h4 class="card__header-secondary">
                            Kanai's Cube
                        </h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"
                                v-for="power in state.powers"
                            >
                                <a href="{{ power.tool_tip_params }}"
                                   data-d3tooltip="{{ power.tool_tip_params }}"
                                >
                                    {{ power.name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card--diablo">
                        <h4 class="card__header-secondary">
                            Active Skills
                        </h4>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"
                                v-for="skill in state.skills | active"
                            >
                                <a href="http://us.battle.net/d3/en/class/{{ state.class.split(' ').join('-') }}/active/{{ skill.slug }}?runeType=a"
                                >
                                    {{ skill.name }}
                                    <img :src="skill.icon | skillIcon" alt="" class="pull-xs-right">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card--diablo">
                        <h4 class="card__header-secondary">
                            Passive Skills
                        </h4>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"
                                v-for="skill in state.skills | passive"
                            >
                                <a href="http://us.battle.net/d3/en/class/{{ state.class.split(' ').join('-') }}/passive/{{ skill.slug }}"
                                >
                                    {{ skill.name }}
                                    <img :src="skill.icon | skillIcon" alt="" class="pull-xs-right">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <main-footer></main-footer>
    </div>
</template>

<script>
    import heroesStore from '../../stores/heroes';
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import mainFooter from '../../components/main-footer/main-footer.vue';
    import jumbo from '../../components/jumbotron/slim.vue';
    import note from '../../components/notes/note.vue';
    import gearBlock from '../../components/hero/gear-block.vue';

    export default {
        data () {
            return {
                state: {}
            }
        },

        components: { mainNavbar, mainFooter, jumbo, note, gearBlock },

        filters: {
            active (obj) {
                if (typeof obj != 'undefined') {
                    return obj.filter(function ($i) {
                        if ($i.type == 'active') {
                            return $i;
                        }
                    });
                }
            },

            passive (obj) {
                if (typeof obj != 'undefined') {
                    return obj.filter(function ($i) {
                        if ($i.type == 'passive') {
                            return $i;
                        }
                    });
                }
            },

            skillIcon (icon) {
                return 'http://media.blizzard.com/d3/icons/skills/21/' + icon + '.png'
            }
        },

        computed: {
            crest () {
                if (typeof this.state.class !== 'undefined') {
                    return BASE_URL + '/img/' + this.state.class.split(' ').join('-') + '/crest.png'
                }
            }
        },

        ready () {
            var id = document.getElementById('hero_id').value;

            heroesStore.byId(id, function () {
                this.state = heroesStore.state;
            }.bind(this));
        },

        methods: {
            update () {
                heroesStore.update(this.state.id);
            }
        }
    }
</script>