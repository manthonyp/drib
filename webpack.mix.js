let mix = require('laravel-mix');

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

mix
    // scripts
    .js('resources/assets/js/app.js', 'public/js')
    // dashboard with available storage
    .scripts([
        'resources/assets/js/fontawesome.js',
        'resources/assets/js/ripple.js',
        'resources/assets/js/dropzone.js',
        'resources/assets/js/dropzone.config.js',
        'resources/assets/js/plyr.js',
        'resources/assets/js/script.js'
    ],  'public/js/vendor98C9E7EB7A66F9AE58B223D3F129B.js')
    // dashboard with full storage
    .scripts([
        'resources/assets/js/fontawesome.js',
        'resources/assets/js/ripple.js',
        'resources/assets/js/plyr.js',
        'resources/assets/js/script.js'
    ],  'public/js/vendor9A8FEF265B72CD8AB1159B445DED3.js')
    // download page wavesurfer audio preview
    .scripts([
        'resources/assets/js/wavesurfer.js'
    ],  'public/js/vendor9GHCJ726OI99ES8EE325981232V98.js')
    // source maps
    .sourceMaps()
    // stylesheets
    .sass('resources/assets/sass/app.scss', 'public/css');
