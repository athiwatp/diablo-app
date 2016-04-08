var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

var resources = 'resources/assets/'
    , modules = 'node_modules/'
    , sm = require('sitemap')
    , fs = require('fs');

elixir(function(mix) {
    // Scss
    mix.sass('app.scss')

    // Misc
    .copy(resources + 'img', 'public/img')
    .copy(modules + 'font-awesome/fonts', 'public/fonts')

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
    .browserSync({open: false, proxy: 'hs.diablo.dev'})

    .version(['css/app.css', 'js/app.js']);

    sitemap = sm.createSitemap({
        hostname: 'http://diablorankings.net',
        cacheTime: 6000000,
        urls: [
            { url: '/', changefreq: 'daily', priority: 1 },
            { url: '/leaderboards', changefreq: 'weekly', priority: .3 },
            { url: 'profiles', changefreq: 'monthly', priority: .3 },
            { url: 'heroes', changefreq: 'monthly', priority: .3 },
        ]
    });

    fs.writeFileSync('public/sitemap.xml', sitemap.toString());
});