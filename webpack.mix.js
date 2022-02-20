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

mix
/* CSS */
    .sass('resources/sass/main.scss', 'public/css/oneui.css')
    .sass('resources/sass/oneui/themes/amethyst.scss', 'public/css/themes/')
    .sass('resources/sass/oneui/themes/city.scss', 'public/css/themes/')
    .sass('resources/sass/oneui/themes/flat.scss', 'public/css/themes/')
    .sass('resources/sass/oneui/themes/modern.scss', 'public/css/themes/')
    .sass('resources/sass/oneui/themes/smooth.scss', 'public/css/themes/')

.styles('resources/views/admin/assets/vendor/bootstrap/css/bootstrap.min.css', 'public/backend/assets/vendor/bootstrap/css/bootstrap.min.css')
    .styles('resources/views/admin/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css', 'public/backend/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')
    .styles('resources/views/admin/assets/fonts/iconic/css/material-design-iconic-font.min.css', 'public/backend/assets/fonts/iconic/css/material-design-iconic-font.min.css')
    .styles('resources/views/admin/assets/fonts/iconic/css/material-design-iconic-font.min.css', 'public/backend/assets/fonts/iconic/css/material-design-iconic-font.min.css')
    .styles('resources/views/admin/assets/vendor/animate/animate.css', 'public/backend/assets/vendor/animate/animate.css')
    .styles('resources/views/admin/assets/vendor/css-hamburgers/hamburgers.min.css', 'public/backend/assets/vendor/css-hamburgers/hamburgers.min.css')
    .styles('resources/views/admin/assets/vendor/animsition/css/animsition.min.css', 'public/backend/assets/vendor/animsition/css/animsition.min.css')
    .styles('resources/views/admin/assets/vendor/select2/select2.min.css', 'public/backend/assets/vendor/select2/select2.min.css')
    .styles('resources/views/admin/assets/vendor/daterangepicker/daterangepicker.css', 'public/backend/assets/vendor/daterangepicker/daterangepicker.css')
    .styles('resources/views/admin/assets/css/util.css', 'public/backend/assets/css/util.css')
    .styles('resources/views/admin/assets/css/main.css', 'public/backend/assets/css/main.css')
    .styles('resources/views/admin/assets/css/ajax_message.css', 'public/backend/assets/css/ajax_message.css')

/* CopyDirectory */
.copyDirectory('resources/views/admin/assets/fonts', 'public/backend/assets/fonts')
    .copyDirectory('resources/views/admin/assets/images', 'public/backend/assets/images')

/* JS */
.js('resources/js/app.js', 'public/js/laravel.app.js')
    .js('resources/js/oneui/app.js', 'public/js/oneui.app.js')

.scripts('resources/views/admin/assets/vendor/jquery/jquery-3.2.1.min.js', 'public/backend/assets/vendor/jquery/jquery-3.2.1.min.js')
    .scripts('resources/views/admin/assets/vendor/animsition/js/animsition.min.js', 'public/backend/assets/vendor/animsition/js/animsition.min.js')
    .scripts('resources/views/admin/assets/vendor/bootstrap/js/popper.js', 'public/backend/assets/vendor/bootstrap/js/popper.js')
    .scripts('resources/views/admin/assets/vendor/bootstrap/js/bootstrap.min.js', 'public/backend/assets/vendor/bootstrap/js/bootstrap.min.js')
    .scripts('resources/views/admin/assets/js/main.js', 'public/backend/assets/js/main.js')
    .scripts('resources/views/admin/assets/js/custom_scripts.js', 'public/backend/assets/js/custom_scripts.js')
    .scripts('resources/views/admin/assets/js/jquery.mask.js', 'public/backend/assets/js/jquery.mask.js')
    .scripts('resources/views/admin/assets/js/jquery.form.js', 'public/backend/assets/js/jquery.form.js')
    .scripts('resources/views/admin/assets/js/jquery-ui.js', 'public/backend/assets/js/jquery-ui.js')
    .scripts('resources/views/admin/assets/js/sweetalert2.js', 'public/backend/assets/js/sweetalert2.js')

/* Page JS */
.js('resources/js/pages/tables_datatables.js', 'public/js/pages/tables_datatables.js')

/* Tools */
// .browserSync('localhost:8000')
//     .disableNotifications()

/* Options */
.options({
    processCssUrls: false
})

.version();
