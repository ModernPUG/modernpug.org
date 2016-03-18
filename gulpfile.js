var log = function(o) { console.log(o); }

var gulp = require('gulp');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var scss = require('gulp-sass');
var rename = require('gulp-rename');


// set directories
var dir = {
	resource : './resources/assets',
	public : './public'
};


// build vendor files
gulp.task('js.vendor', function(){
	gulp.src(dir.resource + '/js/vendor/**/*.js')
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(concat('vendor.pkgd.js', { newLine: '\n\n' }))
		.pipe(sourcemaps.write('maps'))
		.pipe(gulp.dest(dir.public + '/js'));
});


// build app.scss file
gulp.task('scss.fonts', function(){
	gulp.src(dir.resource + '/scss/fonts.scss')
		.pipe(sourcemaps.init())
		.pipe(scss({ outputStyle: 'compressed' }).on('error', scss.logError))
		.pipe(rename({ suffix: '.pkgd' }))
		.pipe(sourcemaps.write('maps'))
		.pipe(gulp.dest(dir.public + '/css'))
});


// build app.scss file
gulp.task('scss.app', function(){
	gulp.src(dir.resource + '/scss/app.scss')
		.pipe(sourcemaps.init())
		.pipe(scss({
			//outputStyle : 'compact'
			outputStyle: 'compressed'
		}).on('error', scss.logError))
		.pipe(rename({ suffix: '.pkgd' }))
		.pipe(sourcemaps.write('maps'))
		.pipe(gulp.dest(dir.public + '/css'))
});
gulp.task('scss.app:watch', function(){
	gulp.watch(dir.resource + '/scss/*.scss', ['scss.app']);
});


// build app.js file
gulp.task('js.app', function(){
	gulp.src(dir.resource + '/js/app/*.js')
		.pipe(sourcemaps.init())
		.pipe(uglify())
		.pipe(concat('app.pkgd.js', { newLine: '\n\n' }))
		.pipe(sourcemaps.write('maps'))
		.pipe(gulp.dest(dir.public + '/js'));
});
gulp.task('js.app:watch', function(){
	gulp.watch(dir.resource + '/js/app/*.js', ['js.app']);
});