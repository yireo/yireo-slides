var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');

gulp.task('less', function () {
    return gulp.src(['less/*.less', 'less/**/*.less'])
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ]
        }))
        .pipe(gulp.dest('css'));
});

gulp.task('watch', function() {
    gulp.watch(['less/*.less', 'less/**/*.less'], gulp.series('less'));
});

gulp.task('default', gulp.series(gulp.parallel('less', 'watch')));
