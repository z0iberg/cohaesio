var gulp        = require('gulp'),
    sass        = require('gulp-sass'),
    sourcemaps  = require('gulp-sourcemaps'),
    browserSync = require('browser-sync'),
    concat      = require('gulp-concat'),
    uglifyjs    = require('gulp-uglifyjs'),
    postcss     = require('gulp-postcss'),
    pug         = require('gulp-pug'),
    sassGlob    = require('gulp-sass-glob'), // use glob imports sass/scss files
    autoprefixer= require('gulp-autoprefixer'),
    plumber     = require('gulp-plumber'),
    babel       = require("gulp-babel"),
    minify      = require('gulp-minify');

gulp.task('pug', function buildHTML(){
  return gulp.src('dev/pug/*.pug')
  .pipe(pug({
    pretty: true,
  }))
  .pipe(gulp.dest('dev'))
});

// STYLE Tasks
gulp.task('sass', function(){
  return gulp.src('dev/sass/style.scss') // джерело файлу
  .pipe(sassGlob())
  .pipe(sourcemaps.init()) // підключення карт
  .pipe(sass({includePaths: ['node_modules/susy/sass']})) // компіляція sass
  .pipe(sourcemaps.write('.')) // записати карту
  .pipe(gulp.dest('dev/css')) // лише назви папок. Коли файл - створить папку
  .pipe(browserSync.reload({ stream: true })) // інжекція файлу прямо в дом
});

// SCRIPT Tasks
// gulp.task('scripts', function(){
//   return gulp.src([
//       'dev/libs/jquery/dist/jquery.min.js',
//       'dev/libs/magnific-popup/dist/jquery.magnific-popup.min.js'
//     ])
//     .pipe(concat('libs.min.js'))
//     .pipe(uglifyjs())
//     .pipe(gulp.dest('dev/js'));
// });

gulp.task('browser-sync', function(){
  browserSync({
    server: {
      baseDir: 'dev' // Папка сервера тут задається
    },
    notify: false // Виключити увідомлєнія )
  })
});

gulp.task('babel', function(){
    return gulp.src('js/es6/*.js')
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(minify({
            ext:{
                src:'-es5.js',
                min:'.js'
            },
        }))
        .pipe(gulp.dest('js'))
        .pipe(browserSync.reload({stream: true}))
});

gulp.task('watch', ['browser-sync', 'pug', 'sass'/*, 'scripts'*/], function(){  // після слова
  gulp.watch('dev/pug/*.pug', ['pug', browserSync.reload]);
  //gulp.watch('dev/*.html', browserSync.reload);
  gulp.watch('dev/sass/**/*.+(scss|sass)', ['sass']);
  gulp.watch('dev/js/**/*.js', browserSync.reload);
  gulp.watch('js/es6/*.js', ['babel']);
  gulp.watch('js/es6/*.js', browserSync.reload);
});
