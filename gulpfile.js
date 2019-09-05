var gulp = require('gulp');
//var watchLess = require('gulp-watch-less');
var less = require('gulp-less');
var path = require('path');

gulp.task('less', function () {
    return gulp.src('less/style.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ]
        }))
        .pipe(gulp.dest('dist'));
});

//gulp.task('watch', function() {
//    return gulp.watch('./*.less', ['less']);
//});

gulp.task('default', ['less']);