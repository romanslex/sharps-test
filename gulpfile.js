const gulp = require("gulp");
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