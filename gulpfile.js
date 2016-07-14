var gulp = require('gulp'),
    inject = require('gulp-inject'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    uglifycss = require('gulp-uglifycss'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    watch = require('gulp-watch'),
    autoprefixer = require('gulp-autoprefixer');

// compile sass
gulp.task('sass', function () {
  return gulp.src('./resources/assets/css/scss/*.scss')
    .pipe(autoprefixer())
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./resources/assets/css/modules/'));
});

// concat js
gulp.task('concatJs', function() {
  return gulp.src([
      './node_modules/jquery/dist/jquery.min.js',
      './node_modules/bootstrap/dist/js/bootstrap.min.js',
      './node_modules/chart.js/dist/Chart.min.js',
      './resources/assets/js/third-party/*.js',
      './node_modules/nestedSortable/jquery.mjs.nestedSortable.js',
      './resources/assets/js/modules/*.js'
    ])
    .pipe(concat('app.js'))
    .pipe(gulp.dest('./public/assets/js/'));
});

//concat css
gulp.task('concatCss', ['sass'], function() {
  return gulp.src([
      './node_modules/bootstrap/dist/css/bootstrap.min.css',
      './node_modules/font-awesome/css/font-awesome.min.css',
      './resources/assets/css/third-party/*.css', 
      './resources/assets/css/modules/*.css'
      
    ])
    .pipe(concat('/app.css'))
    .pipe(gulp.dest('./public/assets/css'));
});

// compress js
gulp.task('compressJs', ['concatJs'], function() {
  return gulp.src('./public/assets/js/app.js')
    .pipe(uglify())
    .pipe(gulp.dest('./public/assets/js'));
});

// compress css
gulp.task('compressCss', ['concatCss'], function() {
  return gulp.src('./public/assets/css/app.css')
    .pipe(uglifycss())
    .pipe(gulp.dest('./public/assets/css'));
});


// gulp watch
gulp.task('watch', function() {
  gulp.watch([
    './resources/assets/js/modules/*.js',
    './resources/assets/js/third-party/*.js',
    './resources/assets/css/scss/*.scss',
    './resources/assets/css/third-party/*.css',
  ], ['default']);
});

// gulp
gulp.task('default', ['sass', 'concatJs', 'concatCss', 'compressCss', 'compressJs']);
