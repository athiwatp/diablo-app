<style lang="scss">
    @import './main-footer';
</style>

<template>
    <footer>
        <banner :parameters="footerBannerParameters">
            <div class="container">
                <h4 class="text-xs-center">Connect with <strong>Diablo Rankings</strong></h4>
                <div class="icons">
                    <div>
                        <a href="mailto:admin@diablorankings.net"
                           target="_blank"
                        >
                            <i class="fa fa-envelope"></i>
                        </a>
                        <p>Email</p>
                    </div>
                    <div>
                        <a href="#">
                            <i class="fa fa-cc-paypal"></i>
                        </a>
                        <p>Donate!</p>
                    </div>
                </div>
            </div>
        </banner>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12 text-xs-center text-white">
                        John Leider &copy; 2016. All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
    import banner from '../banner/banner.vue';

    export default {
        data () {
            return {
                footerBannerParameters: {
                    background: 'url("/img/city-banner.jpg") no-repeat fixed',
                    backgroundPosition: '50% 100%'
                }
            }
        },

        components: {banner}
    }
</script>