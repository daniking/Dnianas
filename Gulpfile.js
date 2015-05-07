var gulp    = require('gulp');
var concat  = require('gulp-concat');
var watch   = require('gulp-watch');
var uglify  = require('gulp-uglify');
var rootDir = 'app/assets/';
var jsDir   = rootDir + 'javascripts/';
var styleDir = 'public/style/';

gulp.task('scripts', function () {
    return gulp.src([
            jsDir + '/vendor/moment.min.js',
            jsDir + '/vendor/**.js',
            jsDir + 'app.js',
            jsDir + 'comment.js',
            jsDir + 'notification.js',
            jsDir + 'post.js',
            jsDir + 'user.js',
            jsDir + 'init.js'
        ])
        .pipe(concat('application.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});

gulp.task('styles', function () {
    return gulp.src([
            styleDir + 'index.css',
            styleDir + 'style.css',
            styleDir + 'jqstdniapara.css',
            styleDir + 'header.css',
            styleDir + 'media.css',
        ])
        .pipe(concat('application.css'))
        .pipe(gulp.dest('./public/stylesheet'));
});

gulp.task('watch', function () {
   gulp.watch(jsDir + '*.js', ['scripts']);
   gulp.watch(styleDir + '*.css', ['styles']);
});

// Default task
gulp.task('default', ['styles', 'scripts', 'watch']);