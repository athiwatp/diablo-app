<style lang="scss">
    @import './_class.scss';
</style>
<template>
    <a class="card card--diablo card--class"
       :class="class"
       :href="href"
    >
        <img :src="image" alt="class" class="card-img-top img-fluid">
        <div class="card-footer card--class__footer">
            <slot></slot>
        </div>
    </a>
</template>

<script>
    export default {
        computed: {
            image () {
                if (! this.img) {
                    return '';
                }

                return BASE_URL + this.img;
            },

            href () {
                if (! this.leaderboard) {
                    return '';
                }

                return BASE_URL + '/leaderboards' + this.leaderboard;
            }
        },

        props: ['img', 'class', 'leaderboard']
    }
</script>