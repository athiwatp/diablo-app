<style lang="scss">
    @import '../../../sass/_variables.scss';

    .power {
        min-height: 80px;
    }
    .power__icon {
        margin-top: -5px;
        display: inline-block;
        float: left;
    }

    .power__label {
        display: inline-block;
        float: left;
        width: 85%;
        margin-top: 15px;
    }

    .hero-aside .list-group-item:hover {
        background-color: #fff;
        color: $secondary-color;
    }

    h5 {
        text-align: center;
        margin-bottom: 1rem;
    }
    
    section {
        margin-bottom: 2rem;
    }

    .gear .row .col-md-4:last-child {
        margin-left: 33.333333333333%;
    }
</style>

<template>
    <div id="page">
        <header>
            <main-navbar></main-navbar>
        </header>

        <div class="container">
        </div>
    </div>
</template>

<script>
    import heroesStore from '../../stores/heroes';
    import mainNavbar from '../../components/main-navbar/main-navbar.vue';
    import note from '../../components/notes/note.vue';
    import gearBlock from '../../components/hero/gear-block.vue';

    export default {
        data () {
            return {
                state: {
                    paragon_level: 0,
                    stats: {
                        damage: 0,
                        toughness: 0,
                        healing: 0
                    }
                }
            }
        },

        components: { mainNavbar, note, gearBlock },

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
            },

            powerIcon (icon) {
                return 'http://media.blizzard.com/d3/icons/items/small/' + icon + '.png';
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

            heroesStore.byId(id, () => {
                this.state = heroesStore.state;
            });
        },

        methods: {
            update () {
                this.state.queued = true;
                heroesStore.update(this.state.id);
            }
        }
    }
</script>