<style lang="scss">
    @import './_gear-block.scss';
</style>

<template>
    <div class="text-xs-center gear-block"
    >
        <h6>{{ item.slot }}</h6>
        <img :src="icon"
             alt="gear-icon">
        <div class="gear-block__item">
            <a href="{{ item.pivot.tool_tip_params }}"
               data-d3tooltip="{{ item.pivot.tool_tip_params }}"
            >
                {{ item.name }}
            </a>
        </div>
    </div>
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