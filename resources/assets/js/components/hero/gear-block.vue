<style lang="scss">
    @import './_gear-block.scss';
</style>

<template>
    <a class="card card--diablo card--gear-block"
       href="{{ item.pivot.tool_tip_params }}"
       data-d3tooltip="{{ item.pivot.tool_tip_params }}"
    >
        <img :src="icon" alt="" class="card-img-top img-fluid">
        <div class="card-footer card--gear-block__footer">
            {{ item.name }}
        </div>
    </a>
</template>

<script>
    export default {
        computed: {
            icon () {
                if (typeof this.item.icon !== 'undefined') {
                    return 'http://media.blizzard.com/d3/icons/items/small/' + this.item.icon + '.png'
                }

                return '';
            }
        },

        props: ['item']
    }
</script>