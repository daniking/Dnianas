var gulp    = require('gulp');
var concat  = require('gulp-concat');
var watch   = require('gulp-watch');
var rootDir = 'app/assets/';
var jsDir   = rootDir + 'javascripts/';

gulp.task('scripts', function () {
    return gulp.src(jsDir + '**.js')
        .pipe(concat('application.js'))
        .pipe(gulp.dest('./public/javascript'));
});

gulp.task('watch', function () {
   gulp.watch(jsDir + '*.js', ['scripts']);
});

// Default task
gulp.task('default', ['scripts', 'watch']);