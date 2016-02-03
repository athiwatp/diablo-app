var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');
require('laravel-elixir-livereload');

var resources = 'resources/assets/';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('index.scss');

    mix.browserify('pages/home/index.js', 'public/js/pages/home/index.js');
    mix.browserify('pages/heroes/index.js', resources + 'build/js/pages/heroes/index.js');
    mix.scripts([
        'build/js/pages/heroes/index.js',
        'js/d3tooltip.js'
    ], 'public/js/pages/heroes/index.js', resources);

    mix.copy('resources/assets/img', 'public/img');
    mix.livereload();
});