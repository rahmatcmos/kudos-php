var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some kudos Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  mix
    .sass(
      './../../resources/assets/themes/kudos/sass/app.scss', 
      './../../resources/assets/themes/kudos/css/modules')
    .styles([
      './node_modules/bootstrap/dist/css/bootstrap.min.css',
      './node_modules/font-awesome/css/font-awesome.min.css',
      './node_modules/swipebox/src/css/swipebox.min.css',
      './../../resources/assets/themes/kudos/css/modules/*.css'
    ], './../../public/build/themes/kudos/css')
    .scripts([
      './node_modules/jquery/dist/jquery.min.js',
      './node_modules/bootstrap/dist/js/bootstrap.min.js',
      './node_modules/swipebox/src/js/jquery.swipebox.min.js',
      './../../resources/assets/themes/kudos/js/third-party/*.js',
      './../../resources/assets/themes/kudos/js/modules/*.js'
    ], './../../public/build/themes/kudos/js')
    .copy(
     './node_modules/font-awesome/fonts',
     './../../public/build/themes/kudos/fonts'
    );
});