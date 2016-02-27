<style lang="scss">
    @import './message';
</style>

<template>
    <div class="message animated"
         :class="[typeClass]"
         v-if="show"
         transition="fade"
    >
        <span class="message__icon">
            <i class="fa" :class="icon"></i>
        </span>
        <span class="message__content">
            {{ message }}
        </span>
        <span class="message__close">
            <i class="fa fa-times-circle" @click="show = false"></i>
        </span>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                show: false,
                icon: '',
                message: '',
                type: ''
            }
        },

        computed: {
            typeClass () {
                switch (this.type) {
                    case 'success':
                        return 'message--success'
                    break;
                    case 'warning':
                        return 'message--warning'
                    break;
                }
            }
        },

        events: {
            'message:show' (type, icon, message) {
                this.show = true;
                this.type = type;
                this.icon = icon;
                this.message = message;
            }
        }
    }
</script>