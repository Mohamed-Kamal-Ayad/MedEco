const mix = require('laravel-mix');
const WebpackRTLPlugin = require('webpack-rtl-plugin');

require('laravel-mix-merge-manifest');

// Adminlte3 Template
mix.js('resources/js/adminlte3/adminlte3.js', 'public/js').vue();
mix.sass('resources/sass/adminlte3/adminlte3.scss', 'public/css');

// Frontend
mix.sass('resources/sass/app.scss', 'public/css');

// Handle rtl
mix.webpackConfig({
    plugins: [
        new WebpackRTLPlugin({
            diffOnly: false,
            minify: true,
        }),
    ],
});

mix.mergeManifest();
