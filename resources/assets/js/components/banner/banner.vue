<style lang="scss">
    @import './banner';
</style>

<template>
    <div class="banner">
        <div class="banner__image"
             :style="parameters"
        ></div>
        <div class="banner__content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['parameters']
    }
</script>