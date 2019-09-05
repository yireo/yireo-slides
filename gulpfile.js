var gulp = require('gulp');
var watchLess = require('gulp-watch-less');
var less = require('gulp-less');

gulp.task('less', function () {
    return gulp.src('less/style.less')
        .pipe(watchLess('less/style.less'))
        .pipe(less())
        .pipe(gulp.dest('dist'));
});

gulp.task('watch', function() {
    return gulp.watch('./*.less', ['less']);
});

gulp.task('default', ['less', 'watch']);