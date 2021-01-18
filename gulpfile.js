/**
 * authors: David Goring, Merlin, ERILD, DEL, ZI.
 Steps:
 1. Install packages: yarn install
 2. Type the following after navigating in your project folder:
 3. Set the WP_THEME constant to the theme's folder name
 4. Type 'yarn run watch' and start developing
 */

const WP_THEME = 'bespoke-theme';
const THEMEPATH = 'public/content/themes/' + WP_THEME;

/* Needed gulp config */
const { series, src, dest, watch }  = require('gulp');
const sass        = require('gulp-sass');
const env         = require('minimist')(process.argv.slice(2));
const named       = require('vinyl-named');
const uglify      = require('gulp-uglify-es').default;
const cssmin      = require('gulp-cssmin');
const plumber     = require('gulp-plumber');
const webpack     = require('webpack-stream');
const sourcemaps  = require('gulp-sourcemaps');
const useref      = require('gulp-css-useref');
const resolve     = require('gulp-resolve-url');
const source      = require('vinyl-source-stream');

/* javascripts task */
function javascript ()
{
  var scripts = src([
    THEMEPATH + '/assets/javascript/main.js'
  ])
    .pipe(plumber())
    .pipe(named())
    .pipe(webpack());

  if(env.production)
  {
    scripts = scripts.pipe(uglify());
  }

  return scripts
    .pipe(dest(THEMEPATH + '/dist/js'));
}


/* Stylesheets task */
function stylesheets ()
{
  var styles = src(THEMEPATH + '/assets/stylesheets/main.scss')
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass({
      includePaths: 'node_modules'
    }))
    .pipe(resolve({attempts: 1}))
    .pipe(useref({
      base: THEMEPATH + '/dist/css',
      pathTransform: function(newAssetFile, cssFilePathRel, urlMatch, options) {
        return urlMatch.replace(/(node_modules|plugins)/g, 'vendor')
               .replace(/^(.*\.\.([/\\][^\.]))?/g, '..$2');;
      }
    }));

  if(env.production)
  {
    styles = styles.pipe(cssmin({ level: 2 }));
  }
  else
  {
    styles = styles.pipe(sourcemaps.write());
  }

  return styles
    .pipe(dest(THEMEPATH + '/dist/css'));
}

function versioning ()
{
  var stream = source('version.txt');

  stream.end(new Date().getTime() + "");

  return stream.pipe(dest(THEMEPATH + '/dist'));
}

function watch_assets ()
{
  /* Watch scss, run the sass task on change. */
  watch([THEMEPATH + '/assets/**/*.scss'], series(stylesheets, versioning));

  /* Watch js, run the scripts task on change. */
  watch([THEMEPATH + '/assets/**/*.js'], series(javascript, versioning));
}


exports.javascript  = javascript;
exports.stylesheets = stylesheets;
exports.versioning  = versioning;
exports.watch       = series(javascript, stylesheets, versioning, watch_assets);
exports.default     = series(javascript, stylesheets, versioning);
