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
  mix.sass('./resources/assets/admin/sass/app.scss', 'resources/assets/admin/css/modules');
    
  mix.styles([
    './node_modules/bootstrap/dist/css/bootstrap.min.css',
    './node_modules/font-awesome/css/font-awesome.min.css',
    './node_modules/summernote/dist/summernote.css',
    './node_modules/dropzone/dist/dropzone.css',
    './node_modules/swipebox/src/css/swipebox.min.css',
    './resources/assets/admin/css/third-party/*.css', 
    './resources/assets/admin/css/modules/*.css'
  ], './public/build/admin/css');
  mix.scripts([
    './node_modules/jquery/dist/jquery.min.js',
    './node_modules/bootstrap/dist/js/bootstrap.min.js',
    './node_modules/dropzone/dist/dropzone.js',
    './node_modules/summernote/dist/summernote.js',
    './node_modules/chart.js/dist/Chart.min.js',
    './resources/assets/admin/js/third-party/*.js',
    './node_modules/nestedSortable/jquery.mjs.nestedSortable.js',
    './node_modules/swipebox/src/js/jquery.swipebox.min.js',
    './resources/assets/admin/js/modules/*.js'
  ], './public/build/admin/js');
    
});