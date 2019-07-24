const mix = require('laravel-mix');

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

mix.js('resources/js/admin/main.js', 'public/js')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/admin'),
            },
        },
        module: {
            rules: [
                {
                    test: /\.svg$/,
                    loader: 'svg-sprite-loader',
                    include: [path.resolve(__dirname, 'resources/js/admin/icons/svg')],
                    options: {
                        symbolId: 'icon-[name]'
                    }
                }
            ],
        }
    })
    .babelConfig({
        "presets": [
            "@vue/app",
        ],
        'plugins': ['dynamic-import-node']
    })
    .extract(['vue','vue-router','vuex','element-ui','axios']);
