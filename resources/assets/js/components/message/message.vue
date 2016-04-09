<style lang="scss" rel="stylesheet/scss">
    @import './message';
</style>

<template>
    <div class="message"
         :class="[type]"
    >
        <span class="message__icon">
            <i class="fa" :class="icon"></i>
        </span>
        <span class="message__content">
            {{{ message }}}
        </span>
        <span class="message__close">
            <i class="fa fa-times-circle" @click="slideUp"></i>
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

        events: {
            'message:show' (type, message, duration) {
                this.showMessage(type, message, duration);
            },

            'message:hide' () {
                this.slideOut();
            }
        },

        methods: {
            showMessage (type, message, duration) {
                this.type = 'message--' + type;
                this.message = message;
                this.setIcon(type);

                if (!this.show) {
                    this.slideDown();
                }

                if (typeof duration != 'undefined') {
                    setTimeout(() => {
                        this.slideUp();
                    }, duration);

                }
            },

            setIcon (type) {
                switch (type) {
                    case 'success':
                        this.icon = 'fa fa-check';
                        break;
                    case 'info':
                        this.icon = 'fa fa-info-circle';
                        break;
                    case 'warning':
                        this.icon = 'fa fa-exclamation-triangle';
                        break;
                    case 'error':
                        this.icon = 'fa fa-times';
                        break;
                }
            },

            slideDown () {
                $('.message').css({
                    display: 'flex'
                }).hide().slideDown();

                this.show = true;
            },

            slideUp () {
                $('.message').slideUp();

                this.show = false;
            }
        }
    }
</script>