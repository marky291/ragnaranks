const webpack = require('webpack');
const mix = require('laravel-mix');

require('laravel-mix-tailwind');

mix.browserSync('https://ragnaranks.test');

// require('laravel-mix-bundle-analyzer');
// mix.bundleAnalyzer();

/*
 |--------------------------------------------------------------------------
 | Custom Mix setup
 |--------------------------------------------------------------------------
 |
 */

mix.webpackConfig({
    plugins: [
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ]
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').version();

mix.sass('resources/sass/app.scss', 'public/css').tailwind().version();
