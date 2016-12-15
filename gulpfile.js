const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir(mix => {
    mix.sass('app.scss')
    .webpack('app.js');
mix.scripts([
    '../bower/laravel-bootstrap-modal-form/src/laravel-bootstrap-modal-form.js',
    '../bower/moment/min/moment.min.js',
    '../bower/moment/locale/fr.js',
    '../bower/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
    '../bower/jquery-ui/jquery-ui.min.js',
    '../js/maskedinput.js'
], 'public/js/vendor.js');
mix.styles([
    /*'../css/bootstrap.min.css',*/
    '../bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
    '../bower/jquery-ui/themes/base/jquery-ui.min.css',
], 'public/css/vendor.css');
});

