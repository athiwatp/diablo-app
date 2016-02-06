<style lang="scss">
    @import "../../../sass/_variables.scss";

    footer {
        background-color: $secondary-color;
        padding: 1rem 0;
        margin-top: 2rem;
    }

    footer a {
        color: #fff;
    }
    
    footer .container {
        margin-top: 0;
    }
</style>

<template>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled m-t-0 m-b-0">
                        <li>
                            <a href="#">
                                <i class="fa fa-envelope"></i> Contact
                            </a>
                            <a href="#" class="m-l-1">
                                <i class="fa fa-twitter"></i> Twitter
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-xs-right text-white">
                    &copy; Copyright 2016
                </div>
            </div>
        </div>
    </footer>
</template>