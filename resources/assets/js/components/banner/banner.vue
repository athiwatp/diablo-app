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
    $(window).scroll(function(){
        $("#top-banner .banner__content").css("opacity", 1 - $(window).scrollTop() / 450);
        $("#top-banner .banner__content").css("margin-top", $(window).scrollTop() / 2);
    });

    export default {
        props: ['parameters']
    }
</script>