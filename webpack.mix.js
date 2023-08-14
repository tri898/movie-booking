const mix = require('laravel-mix');


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

mix.js('resources/admin/js/app.js', 'public/admin/js').
    js('resources/admin/js/pages/login.js', 'public/admin/js/pages/login.js').
    js('resources/admin/js/pages/create-user-manager.js', 'public/admin/js/pages/create-user-manager.js').
    js('resources/admin/js/pages/update-user-manager.js', 'public/admin/js/pages/update-user-manager.js').
    js('resources/admin/js/pages/roles.js', 'public/admin/js/pages/roles.js').
    sass('resources/admin/scss/app.scss', 'public/admin/css').
    version();
