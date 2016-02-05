<template>
    <div id="app">

        <header>

            <navbar></navbar>

            <jumbo>{{ state.name }} {{ state.clan_tag ? '&lt;'+state.clan_tag+'&gt;' : '' }}</jumbo>

        </header>

        <div class="container m-t-3">

            <div class="row">

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

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card card--diablo">

                                <h4 class="card__header-secondary">
                                    Gear
                                </h4>

                                <table class="table">

                                    <tbody class="text-xs-center">
                                        <tr v-for="item in state.items">
                                            <th>{{ item.slot }}</th>
                                            <td>
                                                <a href="{{ item.pivot.tool_tip_params }}"
                                                   data-d3tooltip="{{ item.pivot.tool_tip_params }}"
                                                >
                                                    {{ item.name }}
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
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

                        <div class="col-md-12">
                            <div class="card card--diablo">
                                <h4 class="card__header-secondary">
                                    Active Skills
                                </h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        v-for="skill in state.skills | active"
                                    >
                                        <a href="http://us.battle.net/d3/en/class/{{ state.class}}/active/{{ skill.slug }}?runeType=a"
                                        >
                                            {{ skill.name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card card--diablo">
                                <h4 class="card__header-secondary">
                                    Passive Skills
                                </h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        v-for="skill in state.skills | passive"
                                    >
                                        <a href="http://us.battle.net/d3/en/class/{{ state.class}}/passive/{{ skill.slug }}"
                                        >
                                            {{ skill.name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</template>
<script>
    import heroesStore from '../../stores/heroes';
    import navbar from '../../components/main-navbar/app.vue';
    import jumbo from '../../components/jumbotron/slim.vue';

    export default {
        data: function () {
            return {
                state: {}
            }
        },

        components: {navbar, jumbo},

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
            }
        },

        computed: {
            crest () {
                if (typeof this.state.class !== 'undefined') {
                    return base_url + '/img/' + this.state.class.split(' ').join('-') + '/crest.png'
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