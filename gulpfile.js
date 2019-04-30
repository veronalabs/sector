'use strict';
const gulp = require('gulp');
const sass = require('gulp-sass');
sass.compiler = require('node-sass');
const concat = require('gulp-concat');
const uglyfly = require('gulp-uglyfly');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const browserSync = require('browser-sync').create();

// CSS Concat
gulp.task('concat-css', function (cb) {
    return gulp.src('./assets/src/css/*.css')
        .pipe(concat('style.css'))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('./assets/css'))
        .pipe(browserSync.stream());
    cb();
});
// CSS Concat

// Sass Compile
gulp.task('sass-compile', function (cb) {
    return gulp.src('./assets/src/sass/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./assets/src/css'));
    cb();
});
// Sass Compile

// Sass
gulp.task('sass', gulp.series('sass-compile' , 'concat-css'));
// Sass


// JS Concat - Minify
gulp.task('build-js', function (cb) {
    return gulp.src('./assets/src/js/*.js')
        .pipe(concat("scripts.js"))
        .pipe(uglyfly())
        .pipe(gulp.dest('./assets/js'))
        .pipe(browserSync.stream());
    cb();
});
// JS Concat - Minify


// BrowserSync
gulp.task('browser-sync', function (cb) {
    browserSync.init({
        proxy: "localhost/"
    });
    gulp.watch('./assets/src/sass/**/*.scss', gulp.series('sass'));
    gulp.watch('./assets/src/js/*.js', gulp.series('build-js'));
    gulp.watch("./**/*.php").on('change', browserSync.reload);
    cb();
});
// BrowserSync

// Default
gulp.task('default', gulp.parallel('sass', 'build-js', 'browser-sync'));
// Default