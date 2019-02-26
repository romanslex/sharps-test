const gulp = require("gulp");
const sass = require('gulp-sass');
sass.compiler = require('node-sass');

const webpackStream = require("webpack-stream");

gulp.task("webpack-dev", () =>
    gulp.src(".")
        .pipe(webpackStream(require("./webpack.dev")))
        .pipe(gulp.dest("public"))
);
gulp.task("webpack-prod", function () {
    return gulp.src(".")
        .pipe(webpackStream(require("./webpack.prod.js")))
        .pipe(gulp.dest("public"))
});

gulp.task('sass', function () {
    return gulp.src('./resources/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./public/css'));
});