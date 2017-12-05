'use strict';

const gulp = require('gulp');
const uglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');

gulp.task('scripts', function () {
    return gulp.src('assets/js/mobile-menu.jquery.js')
        .pipe(uglify())
        .pipe(rename(function(path) {
            path.extname = '.min' + path.extname;
        }))
        .pipe(gulp.dest('assets/js'));
});

gulp.task('styles', function () {
    return gulp.src('assets/css/mobile-menu.css')
        .pipe(cleanCSS({restructuring: false}))
        .pipe(rename(function(path) {
            path.extname = '.min' + path.extname;
        }))
        .pipe(gulp.dest('assets/css'));
});

gulp.task('default', ['scripts', 'styles']);
