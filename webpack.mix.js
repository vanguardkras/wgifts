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


mix.js('resources/js/functions.js', 'public/js')
    .js('resources/js/main.js', 'public/js')
   .styles(['resources/css/admin.css'], 'public/css/admin.css')
   .styles(['resources/css/list.css'], 'public/css/list.css')
   .styles([
       'resources/css/main.css',
       'resources/css/preview.css'
   ], 'public/css/main.css');

