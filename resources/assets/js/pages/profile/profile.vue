<template>
    <div id="page">

        <header>
            <navbar></navbar>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card--diablo text-xs-center">
                                <img src="http://us.battle.net/d3/static/images/follower/templar/crest.png" alt="" class="card-img-top img-fluid">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">North America</li>
                                    <li class="list-group-item">
                                        <a href="#">Battle.net</a>
                                    </li>
                                    <li class="list-group-item">
                                        <p>
                                            <small>Last updated: 6 days ago</small>
                                        </p>
                                        <div>
                                            <button class="btn btn--secondary-outline m-t-2">Update</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card card--diablo">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <span class="font-weight-bold">Elite Kills</span>
                                        <span class="pull-xs-right label label--diablo">2,921</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="font-weight-bold">Lifetime Kills</span>
                                        <span class="pull-xs-right label label--diablo">12,921</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card card--diablo">

                                <h4 class="card__header-secondary">
                                    Heroes
                                </h4>

                                <table class="table">

                                    <tbody class="text-xs-center">

                                    <tr v-for="record in state">
                                        <td>{{ record.name }}</td>
                                        <td>{{ record.level }}</td>
                                        <td>
                                            <span class="text--{{ record.class }}">{{ record.class }}</span>
                                        </td>
                                        <td>{{ record.mode }}</td>
                                        <td>
                                            <button class="btn btn-sm btn--secondary-outline">Profile</button>
                                        </td>
                                    </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</template>
<script>
    import navbar from '../../components/main-navbar/main-navbar.vue';

    export default {
        data: function () {
            return {
                state: [
                    {
                        name: 'zeroskillz',
                        class: 'barbarian',
                        level: 70,
                        mode: 'Season'
                    },
                    {
                        name: 'zeroskillz',
                        class: 'barbarian',
                        level: 70,
                        mode: 'Season'
                    },
                    {
                        name: 'zeroskillz',
                        class: 'barbarian',
                        level: 70,
                        mode: 'Season'
                    },
                    {
                        name: 'zeroskillz',
                        class: 'barbarian',
                        level: 70,
                        mode: 'Season'
                    },
                ]
            }
        },

        components: {navbar}
    }
</script>