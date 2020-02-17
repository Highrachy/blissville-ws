
var 
	gulp = require('../node_modules/gulp'),
	concat = require('../node_modules/gulp-concat');
	uncss = require('../node_modules/gulp-uncss');
	size = require('../node_modules/gulp-size');
	uglify = require('../node_modules/gulp-uglify');
	imagemin = require('gulp-imagemin'),

// file locations
	source = 'source/';
	dest = 'build/';

	// Styles location
	styles = {
		src: 'assets/css/',
		dest: 'assets/css/compressed/',
		animate: 'assets/less/animate.less'
	};


	// image location
	images = {
		in: source + 'images/*.*',
		out: dest + 'images/'
	};

//Styles Task
gulp.task('styles', function() {
  return gulp.src(styles.src + 'main.css') // get the main.css file
  
  	.pipe(size())

  	// .pipe(gulp.dest(styles.dest)) // place it in destination folder

    .pipe(concat('main.min.css')) //used to rename

  	.pipe(uncss({
  		html:[ 
  				'http://localhost/blissville/',
  				'http://localhost/blissville/about-us.php',
  				'http://localhost/blissville/article.php',
  				'http://localhost/blissville/contact-us.php',
  				'http://localhost/blissville/faqs.php',
  				'http://localhost/blissville/investors.php',
  				'http://localhost/blissville/login.php',
  				'http://localhost/blissville/our-portfolio.php',
  				'http://localhost/blissville/register.php',
  				'http://localhost/blissville/single-article.php'
  				],


      ignore: [

                /(#|\.)fancybox(\-[a-zA-Z]+)?/,
                // Bootstrap selectors added via JS
                /\w\.in/,
                /tooltip/,
                ".fade",
                ".collapse",
                ".collapsing",
                /(#|\.)navbar(\-[a-zA-Z]+)?/,
                /(#|\.)dropdown(\-[a-zA-Z]+)?/,
                /(#|\.)(open)/,
                // injected via JS
                /disabled/,
                /\.no\-js/,
                // Custom Css
                /animated/,
          ],
      ignoreSheets : [/fonts.googleapis/]
  	}))


  	.pipe(gulp.dest(styles.src)) // place it in destination folder

  	.pipe(size())
  ;
});

// Concat Styes
gulp.task('concat_styles',['styles'], function() {
  return gulp.src([styles.dest+'main.css',styles.src + 'animate.css'])

    .pipe(size())
    .pipe(concat('main.min.css'))
    .pipe(gulp.dest(styles.src))
    .pipe(size())
  ; // ending semi-colon
});

//Manage Images

gulp.task('images', function(){
	return gulp.src(images.in)
		.pipe(imagemin())
		.pipe(gulp.dest(images.out));
});

// default task
gulp.task('default', ['styles'], function() {

});
