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
  mix.sass('./resources/assets/sass/app.scss', './resources/assets/css/modules');
    
  mix.styles([
    './node_modules/bootstrap/dist/css/bootstrap.min.css',
    './node_modules/font-awesome/css/font-awesome.min.css',
    './resources/assets/css/third-party/*.css', 
    './resources/assets/css/modules/*.css'
  ], './../../public/build/themes/kudos/css');
  mix.scripts([
    './resources/assets/js/third-party/*.js',
    './resources/assets/js/modules/*.js'
  ], './../../public/build/themes/kudos/js');
    
});