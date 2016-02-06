<style lang="scss">
    @import './_class.scss';
</style>
<template>
    <a class="card card--diablo card--class" :class="class">
        <img :src="image" alt="" class="card-img-top img-fluid">
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
            }
        },

        props: ['img', 'class']
    }
</script>