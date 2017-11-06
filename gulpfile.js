var gulp = require('gulp');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var minifyCSS = require('gulp-csso');
var stripCSS = require('gulp-strip-css-comments');
var stripJS = require('gulp-strip-comments');

// Dependências do Site
var paths = {
    js: [
        './node_modules/jquery/dist/jquery.min.js'
    ],
    css: [
        './node_modules/bootstrap/dist/css/*.min.css'
    ]
};

var fonts = [
    './node_modules/bootstrap/fonts/glyphicons-halflings-regular.*'
];


gulp.task('js', function () {
    return gulp.src(paths.js)
            .pipe(concat('libs.js'))
            .pipe(stripJS())
            .pipe(gulp.dest('./web/assets/js/'));
});

gulp.task('css', function () {
    return gulp.src(paths.css)
            .pipe(concat('libs.css'))
            .pipe(stripCSS())
            .pipe(minifyCSS())
            .pipe(gulp.dest('./web/assets/css/'));
});

gulp.task('fonts', function () {
    return gulp.src(fonts)
            .pipe(gulp.dest('./web/assets/css/fonts/'));
});

gulp.task('default', [
    'js',
    'css',
    'fonts'
]);