const { mix } = require('laravel-mix');

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

/*
 mix.scripts([
 'resources/assets/js/app.js',
 'resources/assets/js/dateSupport.js'
 ], 'public/js')
 .sass('resources/assets/sass/app.scss', 'public/css');
 */

mix.scripts([
    'resources/assets/bower/jquery-ui/jquery-ui.js',
    'resources/assets/js/dateSupport.js',
    'resources/assets/js/maskedInput.js',
    'resources/assets/bower/laravel-bootstrap-modal-form/src/laravel-bootstrap-modal-form.js'
], 'public/js/script.js');


mix.styles([
    'resources/assets/bower/jquery-ui/themes/base/jquery-ui.min.css'
], 'public/css/vendor.css')

mix.js('resources/assets/js/app.js', 'public/js');
mix.sass('resources/assets/sass/app.scss', 'public/css');