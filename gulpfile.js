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
	// Scss
    mix.sass('index.scss')
    
    // JS libs
	.scripts([
		'd3tooltip.js'
	], 'public/js/libs.js')

    // Misc
    .copy('resources/assets/img', 'public/img')

    // Pages
    .browserify('pages/home/index.js', 'public/js/pages/home/index.js')
    .browserify('pages/heroes/index.js', 'public/js/pages/heroes/index.js')

    // Browsersync
    .browserSync();
});