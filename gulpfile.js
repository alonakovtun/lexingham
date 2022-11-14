let themeAssetsPath = "wp-content/themes/anomeo/assets/";

const { src, dest, series, watch } = require("gulp");
const webpack = require("webpack-stream");
const babel = require("gulp-babel");
const uglify = require("gulp-uglify");
const sass = require("gulp-sass");
const concat = require("gulp-concat");
const autoprefixer = require("gulp-autoprefixer");

function scripts() {
    return (
        src([themeAssetsPath + "js/main.js"])
            .pipe(webpack({ mode: "development" }))
            // .pipe(webpack({ mode: "production" }))
            .pipe(babel({ presets: ["@babel/env"] }))
            // .pipe(uglify())
            .pipe(concat("main.min.js"))
            .pipe(dest(themeAssetsPath + "js"))
    );
}

function styles() {
    return src(themeAssetsPath + "scss/main.scss")
        .pipe(sass({ outputStyle: "compressed" }))
        .pipe(concat("main.min.css"))
        .pipe(
            autoprefixer({
                overrideBrowserslist: ["last 5 versions"],
                grid: true,
                flexbox: false,
            })
        )
        .pipe(dest(themeAssetsPath + "css"));
}

function startwatch() {
    watch(themeAssetsPath + "scss/**/*", { usePolling: true }, styles);
    watch(
        [themeAssetsPath + "js/**/*.js", `!${themeAssetsPath}js/**/*.min.js`],
        { usePolling: true },
        scripts
    );
}

exports.scripts = scripts;
exports.styles = styles;
exports.default = series(scripts, styles, startwatch);
