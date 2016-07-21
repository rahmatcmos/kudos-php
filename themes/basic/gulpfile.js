var elixir = require('laravel-elixir');

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
  mix.sass('./../../resources/assets/themes/basic/sass/app.scss', './../../resources/assets/themes/basic/css/modules');
    
  mix.styles([
    './node_modules/bootstrap/dist/css/bootstrap.min.css',
    './node_modules/font-awesome/css/font-awesome.min.css',
    './../../resources/assets/themes/basic/css/third-party/*.css', 
    './../../resources/assets/themes/basic/css/modules/*.css'
  ], './../../public/build/themes/basic/css');
  mix.scripts([
    './../../resources/assets/themes/basic/js/third-party/*.js',
    './../../resources/assets/themes/basic/js/modules/*.js'
  ], './../../public/build/themes/basic/js');
    
});