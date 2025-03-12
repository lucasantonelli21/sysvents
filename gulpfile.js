import gulp from "gulp";
import gulpSass from "gulp-sass";
import * as dartSass from 'sass';
import concat from "gulp-concat";
import debug from "gulp-debug";
import rename from "gulp-rename";
import { deleteAsync as del } from "del";
import minifyCss from "gulp-clean-css";
import terser from "gulp-terser";
import yargs from "yargs";
import { hideBin } from "yargs/helpers";

const argv = yargs(hideBin(process.argv)).argv;
const sass = gulpSass(dartSass);

// Exemplo de tarefa de compilação SASS
gulp.task("sass", function () {
  return gulp.src("src/scss/**/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(gulp.dest("dist/css"));
});

// Exemplo de tarefa de minificação de CSS
gulp.task("minify-css", function () {
  return gulp.src("dist/css/**/*.css")
    .pipe(minifyCss())
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest("dist/css"));
});

// Exemplo de tarefa de minificação de JS
gulp.task("minify-js", function () {
  return gulp.src("src/js/**/*.js")
    .pipe(debug({ title: "Minifying:" }))
    .pipe(terser())
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest("dist/js"));
});

// Exemplo de tarefa de limpeza
gulp.task("clean", function () {
  return del(["dist"]);
});

// Exemplo de tarefa de watch
gulp.task("watch", function () {
  gulp.watch("src/scss/**/*.scss", gulp.series("sass", "minify-css"));
  gulp.watch("src/js/*.js", gulp.series("minify-js"));
});

gulp.task("default", gulp.series("clean", "sass", "minify-css", "minify-js"));
var buildDir = 'public/assets';
var assetsDir = 'resources/assets';

var scssFiles = [
	assetsDir + '/scss/app.scss'
];

var jsFiles = [
	assetsDir + '/js/*.js',
	assetsDir + '/js/*/.js',
];

var scssWatchFiles = [
	assetsDir + '/scss/*/.scss'
];

var vendorJsFiles = [
    'node_modules/jquery/dist/jquery.js',
    'node_modules/@popperjs/core/dist/umd/popper.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'node_modules/select2/dist/js/select2.js',
    'node_modules/chart.js/dist/chart.umd.js',
    'node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.js',
    // 'node_modules/select2/dist/js/i18n/pt-BR.js',
    // 'node_modules/parsleyjs/dist/parsley.js',
	// 'node_modules/parsleyjs/dist/i18n/pt-br.js',
    // 'node_modules/moment/moment.js',
	// 'node_modules/moment/locale/pt-br.js',
    // 'node_modules/jquery-mask-plugin/dist/jquery.mask.js',
    // 'node_modules/bootbox/bootbox.js',
    // 'node_modules/@googlemaps/js-api-loader/dist/index.min.js',
    // 'node_modules/@fancyapps/ui/dist/fancybox/fancybox.umd.js',
    // 'node_modules/chartjs-plugin-annotation/dist/chartjs-plugin-annotation.min.js',
    // 'node_modules/jquery-toast-plugin/dist/jquery.toast.min.js',
    // 'node_modules/jquery-ui/dist/jquery-ui.js',
];

var vendorCssFiles = [
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/select2/dist/css/select2.css',
    // 'node_modules/select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.css',
    // 'node_modules/animate.css/animate.css',
    // 'node_modules/@fancyapps/ui/dist/fancybox/fancybox.css',
    // 'node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',
    // 'node_modules/jquery-ui/dist/themes/base/jquery-ui.css',
];

// ---------------------------------------------------------------------------------------------------
// Copy assets

function copyAssets(files, dest) {

    return gulp.src(files, { cwd : assetsDir })
        .pipe(gulp.dest(buildDir + '/' + dest));
}

function copyFonts() {
    return copyAssets('fonts/*/', 'fonts');
}

function copyImages() {
    return copyAssets('images/*/', 'images');
}

// ---------------------------------------------------------------------------------------------------
// Css

function cssTasks(files, outputName, env = 'dev') {

	var obj = gulp.src(files)
        .pipe(debug({ title: 'css-debug' }))
        .pipe(concat(outputName + '.scss'))
        .pipe(sass({
            outputStyle: env == 'prod' ? 'compressed' : 'expanded'
        }).on('error', sass.logError))
        .pipe(rename(outputName + '.min.css'));

    if (env == 'prod') {
        obj.pipe(minifyCss({ compatibility: 'ie8' }));
    }

    return obj.pipe(gulp.dest(buildDir + '/css'));
}

function cssDev() {
    return cssTasks(scssFiles, 'styles');
}

function cssProd() {
    return cssTasks(scssFiles, getVersionedName('styles'), 'prod');
}

function vendorCssDev() {
	return cssTasks(vendorCssFiles, 'vendor');
}

function vendorCssProd() {
	return cssTasks(vendorCssFiles, getVersionedName('vendor'), 'prod');
}

// ---------------------------------------------------------------------------------------------------
// Js

function jsTasks(files, outputName, env = 'dev') {

	var obj = gulp.src(files)
        .pipe(debug({ title: 'js-debug' }))
        .pipe(concat(outputName + '.js'));

    if (env == 'prod') {
        obj = obj.pipe(terser({
            output: { comments: false }
        }));
    }

    return obj.pipe(rename(outputName + '.min.js'))
	    .pipe(gulp.dest(buildDir + '/js'));
}

function jsDev() {
    return jsTasks(jsFiles, 'scripts');
}

function jsProd() {
    return jsTasks(jsFiles, getVersionedName('scripts'), 'prod');
}

function vendorJsDev() {
	return jsTasks(vendorJsFiles, 'vendor');
}

function vendorJsProd() {
	return jsTasks(vendorJsFiles, getVersionedName('vendor'), 'prod');
}

// ---------------------------------------------------------------------------------------------------
// Theme tasks

function themeCss() {

    var files = [
        assetsDir + '/theme/scss/style.scss'
    ];

    return cssTasks(files, 'theme');
}

function themeJs() {

    var files = [
        assetsDir + '/theme/js/*.js'
    ];

    return jsTasks(files, 'theme', 'prod');
}

// ---------------------------------------------------------------------------------------------------
// Função de versionamento

/**
 * Obtem o nome do arquivo de saída versionado
 * @param {*} name
 * @returns
 */
function getVersionedName(name) {

	if (argv.tag && argv.tag !== true) {
		name = name + '-' + argv.tag;
	}

	return name;
}

// ---------------------------------------------------------------------------------------------------
// Tasks avulsas

/**
 * Monitora a alteração e realiza a publicação dos arquivos
 * @returns
 */
function watch() {

    gulp.watch(assetsDir + '/scss/*/*.scss', cssDev);

    gulp.watch(assetsDir + '/fonts/*/', copyFonts);

    gulp.watch(assetsDir + '/images/*/', copyImages);

    gulp.watch(assetsDir + '/js/*.js', jsDev);

    //gulp.watch(assetsDir + '/theme/scss/*/.scss', themeCss);
    //gulp.watch(assetsDir + '/theme/js/*/.js', themeJs);
}

gulp.task('clean', function() {
    return del([buildDir]);
});

gulp.task('build', gulp.series(
    'clean',
    cssProd,
	jsProd,
    vendorCssProd,
	vendorJsProd,
    copyImages,
    copyFonts,
));

gulp.task('default', gulp.series(
    'clean',
    //themeCss,
    //themeJs,
    cssDev,
	jsDev,
    vendorCssDev,
	vendorJsDev,
    copyImages,
    copyFonts,
));

gulp.task('watch', gulp.series(
    'default',
    watch
));
