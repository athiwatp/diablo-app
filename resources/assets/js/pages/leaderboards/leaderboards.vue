<style xmlns:v-el="http://www.w3.org/1999/xhtml" xmlns:v-el="http://www.w3.org/1999/xhtml">
    .pager li a {
        border-radius: 0;
    }
</style>

<template>
    <div id="page">
        <header>
            <main-navbar></main-navbar>
        </header>

        <div class="container">
            <h2 class="section-header">Leaderboards</h2>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-inline text-xs-center">
                        <li class="nav-item m-b-2"
                            v-for="board in leaderboards"
                        >
                            <a class="btn btn--secondary"
                               href="/leaderboards/{{ board | leaderboardLink }}"
                            >
                                {{ board }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 text-xs-center m-b-2">
                    <a href="#"
                       style="color: #fff; text-decoration: none;"
                       @click="search()"
                       v-if="!searchBar"
                    >
                        Search <i class="material-icons">search</i>
                    </a>
                    <input type="text"
                           class="form-control"
                           style="border-radius: 0px" v-show="searchBar"
                           v-el:search-bar-input
                           v-model="searchText"
                           debounce="1000"
                    >
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-border table-hover"
                           style="background: #fff;"
                    >
                        <tbody>
                            <tr v-for="(index, ranking) in state.data">
                                <td class="text-xs-center"
                                    v-if="!this.searchText"
                                >
                                    {{ (index + 1) + ((currentPage - 1) * 25) }}
                                </td>
                                <td class="text-xs-center">
                                    <span class="label label--tertiary">{{ ranking.rift_level }}</span>
                                </td>
                                <td class="text-xs-right">
                                    <span :class="ranking.class | classText"
                                          class="hidden-md-down"
                                    >
                                        {{ ranking.class | capitalize }}
                                    </span>
                                    <img :src="ranking | classPortrait"
                                         alt=""
                                         class="class-portrait"
                                    >
                                </td>
                                <td class="text-xs-center">
                                    <a href="/heroes/{{ ranking.hero.id }}">
                                        {{ ranking.profile.battle_tag | battleTag }}
                                    </a>
                                    <a href="#">{{ ranking.hero.clan_tag ? '&lt;' + ranking.hero.clan_tag + '&gt;' : '' }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 m-b-3">
                    <a href="#"
                       @click.prevent="prevPage"
                       class="btn btn--secondary-outline pull-xs-left"
                       v-if="state.prev_page_url"
                    >
                        Previous
                    </a>
                    <a href="#"
                       @click.prevent="nextPage"
                       class="btn btn--secondary-outline pull-xs-right"
                       v-if="state.next_page_url"
                    >
                        Next
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import http from '../../services/http';

    export default {
        data () {
            return {
                state: {
                    next_page_url: ''
                },
                leaderboards: [
                    'Barbarians', 'Crusaders', 'Demon Hunters', 'Monks', 'Witch Doctors', 'Wizards', '2 Players', '3 Players', '4 Players'
                ],
                searchBar: false,
                searchText: '',
                currentPage: 1,
                currentType: '',
                type: ''
            }
        },

        ready () {
            this.type = document.getElementById('type').value;
            this.loadLeaderboards();
        },

        watch: {
            searchText () {
                this.querySearch();
            }
        },

        filters: {
            leaderboardLink (link) {
                return link.toLowerCase().replace(' ', '');
            }
        },

        components: { mainNavbar },

        methods: {
            loadLeaderboards () {
                this.$http.get(BASE_URL + '/api/leaderboards/' + this.type, function (state) {
                    this.state = state;
                });
            },
            nextPage () {
                this.currentPage++;
                this.$http.get(this.queryPage(), {page: this.currentPage}, function (state) {
                    this.state = state;
                });
            },
            prevPage () {
                this.currentPage--;
                this.$http.get(this.queryPage(), {page: this.currentPage}, function (state) {
                    this.state = state;
                });
            },
            search () {
                this.searchBar = !this.searchBar;
                this.$nextTick(function () {
                    this.$els.searchBarInput.focus();
                });
            },
            querySearch () {
                var self = this;
                this.$http.get(this.queryPage(), {searchText: this.searchText}, function (state) {
                    this.state = state;
                });
            },
            queryPage () {
                return BASE_URL + '/api/leaderboards/' + this.type;
            }
        }
    }
</script>