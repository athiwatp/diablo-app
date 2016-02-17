<style lang="scss">
    @import './main-footer';
</style>

<template>
    <banner :parameters="footerBannerParameters">
        <div class="container">
            <h4>Connect with <strong>Diablo Rankings</strong></h4>
            <div class="icons">
                <div>
                    <a href="#">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <p>Contact me</p>
                </div>
                <div>
                    <a href="#">
                        <i class="fa fa-cc-paypal"></i>
                    </a>
                    <p>Donate!</p>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-xs-center text-white">
                        John Leider &copy; 2016. All rights reserved
                    </div>
                </div>
            </div>
        </footer>
    </banner>
</template>

<script>
    import banner from '../banner/banner.vue';

    export default {
        data () {
            return {
                footerBannerParameters: {
                    background: 'url("/img/footer.jpg") no-repeat fixed',
                    backgroundSize: 'cover',
                    backgroundPosition: '50% 250px'
                }
            }
        },

        components: {banner}
    }
</script>