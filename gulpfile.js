var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

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
    mix.sass('index.scss')
       .browserify('pages/home/index.js')
       .browserify('pages/heroes/index.js', resources + 'build/js/pages/heroes/index.js')
       .scripts([
	        'build/js/pages/heroes/index.js',
	        'js/d3tooltip.js'
	    ], 'public/js/pages/heroes/index.js', resources)
       .copy('resources/assets/img', 'public/img')
       .browserSync();
});