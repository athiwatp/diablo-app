<style lang="scss" rel="stylesheet/scss">
    @import './main-footer';
</style>

<template>
    <footer>
        <banner :parameters="footerBannerParameters">
            <div class="container">
                <h4 class="text-xs-center">Connect with <strong>Diablo Rankings</strong></h4>
                <div class="icons">
                    <div>
                        <a href="mailto:john.j.leider@gmail.com"
                           target="_blank"
                        >
                            <i class="fa fa-envelope"></i>
                        </a>
                        <p>Email</p>
                    </div>
                    <div>
                        <form action="https://www.paypal.com/cgi-bin/webscr"
                              method="post"
                              target="_blank"
                        >
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="8DHSQRB6WRMUN">
                            <input type="hidden" name="submit">
                            <button type="submit"
                                    class="paypal"
                            >
                                <i class="fa fa-cc-paypal"></i>
                            </button>
                            <img alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
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
                    background: 'url("/img/footer-banner.jpg") no-repeat fixed',
                    backgroundPosition: '50% 100%'
                }
            }
        },

        components: {banner}
    }
</script>