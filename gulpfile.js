var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

var resources = 'resources/assets/';
var modules = 'node_modules/';

elixir(function(mix) {
    // Scss
    mix.sass('app.scss')

    // Misc
    .copy('resources/assets/img', 'public/img')

    // Browserify
    .browserify('app.js', resources + 'build/js/app.js')

    // Scripts
    .scripts([
        modules + 'jquery/dist/jquery.min.js',
        modules + 'tether/dist/js/tether.min.js',
        modules + 'bootstrap/dist/js/bootstrap.min.js',
        resources + 'build/js/app.js'
    ], 'public/js/app.js', './')

    // JS libs
    .scripts([
        'libs/d3tooltip.js'
    ], 'public/js/libs.js')

    // Browsersync
    .browserSync({open: false, proxy: 'hs.diablo.dev'});
});