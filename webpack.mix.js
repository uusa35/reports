const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(['resources/js/app.js'], 'public/js/')
    .scripts('resources/js/jquery-3.3.1.slim.min.js','public/js/jquery.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/app-rtl.scss', 'public/css')
    .sourceMaps().version();
