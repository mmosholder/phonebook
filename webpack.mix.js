const mix = require('laravel-mix');
const StyleLintPlugin = require("stylelint-webpack-plugin");
require('laravel-mix-eslint');


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig = ({
    module: {
        rules: [
            {
                test: /\.(graphql|gql)$/,
                exclude: /node_modules/,
                loader: "graphql-tag/loader"
            }
        ]
    },
    plugins: [
        new StyleLintPlugin({
            configFile: ".stylelintrc",
            context: "resources/assets/scss",
            files: [
                // "components/*.scss",
                // "base/*.scss",
                // "helpers/*.scss",
                // "utilities/*.scss",
                "app.scss"
            ],
            syntax: "scss",
            failOnError: false,
            quiet: false,
        })
    ],
    output: {
        publicPath: "/",
        chunkFilename: "js/[name].js"
    }
});

mix.ts('resources/js/app.ts', 'public/js').vue({ version: 2 })
    .eslint({
        extensions: ['ts', 'vue'],
        fix: true
    })
    .sass('resources/scss/app.scss', 'public/css').options({
        processCssUrls: false
    })
// .copy("resources/vendor", "public/vendor");


if (!mix.inProduction()) {
    mix.sourceMaps();
}

if (mix.inProduction()) {
    mix.version();
}