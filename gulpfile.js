var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

var resources = 'resources/assets/';

elixir(function(mix) {
    // Scss
    mix.sass('app.scss')

    // JS libs
    .scripts([
        'libs/d3tooltip.js'
    ], 'public/js/libs.js')

    // Misc
    .copy('resources/assets/img', 'public/img')

    // Browserify
    .browserify('app.js')

    // Browsersync
    .browserSync();
});