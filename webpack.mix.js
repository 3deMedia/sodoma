const mix = require('laravel-mix');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
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

mix.js('resources/js/app.js', 'public/js')
.js('resources/js/datatables.js', 'public/js')
.js('resources/js/admin.js', 'public/js')
.js('resources/js/maps.js', 'public/js')
.js('resources/js/mixin-styles.js', 'public/js')
.js('resources/js/lozad.js', 'public/js')
.js('resources/js/profileform.js', 'public/js')

.sass('resources/scss/app.scss', 'public/css').options({processCssUrls:true})
.sass('resources/scss/secrets.scss', 'public/css').options({processCssUrls:true})
.sass('resources/scss/secrets_front.scss', 'public/css').options({processCssUrls:true});
mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce')


if (mix.inProduction()) {
    mix.options({
        minimize:true,
        minimizer: [new UglifyJsPlugin({
            uglifyOptions: {
              warnings: false,
              parse: {},
              compress: true,
              mangle: true, // Note `mangle.properties` is `false` by default.
              output: null,
              toplevel: false,
              nameCache: null,
              ie8: false,
              keep_fnames: false,
            },
          })],
      }).version();
}
