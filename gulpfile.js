const { src, dest, watch, series, parallel } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("autoprefixer");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");
const cssnano = require("cssnano");
const terser = require("gulp-terser-js");
const imagemin = require("gulp-imagemin"); // Minificar imagenes
const cache = require("gulp-cache");
const webp = require("gulp-webp");
// const javascriptObfuscator = require("javascript-obfuscator");
// const clean = require("gulp-clean");
// const notify = require("gulp-notify");
// const concat = require("gulp-concat");
// const rename = require("gulp-rename");

const paths = {
  imagenes: "src/img/**/*.{png,jpg}",
  scss: "src/scss/**/*.scss",
  js: "src/js/**/*.js",
};

// Funcion que compilas SASS
function css() {
  return (
    src(paths.scss)
      .pipe(sourcemaps.init())
      .pipe(sass())
      .pipe(postcss([autoprefixer(), cssnano()]))
      // .pipe(postcss([autoprefixer()]))
      .pipe(sourcemaps.write("."))
      .pipe(dest("./public/build/css"))
  );
}

function javascript(done) {
  src(paths.js)
    // .pipe(concat("bundle.js"))
    .pipe(terser())
    .pipe(sourcemaps.write("."))
    // .pipe(javascriptObfuscator())
    .pipe(dest("./public/build/js"));
  done();
}

function imagenes() {
  return src(paths.imagenes)
    .pipe(cache(imagemin({ optimizationLevel: 2 })))
    .pipe(dest("./public/build/img"));
}

function versionWebp() {
  return src(paths.imagenes).pipe(webp()).pipe(dest("./public/build/img"));
}

function watchArchivos() {
  watch(paths.scss, css);
  watch(paths.js, javascript);
  watch(paths.imagenes, imagenes);
  watch(paths.imagenes, versionWebp);
}

exports.css = css;
exports.watchArchivos = watchArchivos;
exports.default = parallel(
  css,
  javascript,
  imagenes,
  versionWebp,
  watchArchivos
);
