var gulp = require("gulp");
var sass = require("gulp-sass");
var autoprefixer = require('gulp-autoprefixer');
var minCss = require('gulp-minify-css');
var browserSync = require("browser-sync").create();

gulp.task("sass", function()
{
	return gulp.src("./sass/*.sass")
	.pipe(sass())
	.pipe(autoprefixer({browsers: ['last 2 versions']}))
	.pipe(minCss())
	.pipe(gulp.dest("./css"))
	.pipe(browserSync.stream());
});

gulp.task("serve", ["sass"], function()
{
	browserSync.init({
		open: 'external',
		host: 'portfolio.loc',
		proxy: 'portfolio.loc',
		port: 8080
	});

	gulp.watch("./sass/*.sass", ["sass"]);
	gulp.watch("./*.php").on("change", browserSync.reload);
	gulp.watch("./languages/*.php").on("change", browserSync.reload);
	gulp.watch("./js/*.js").on("change", browserSync.reload);
});

gulp.task("default", ["serve"]);
