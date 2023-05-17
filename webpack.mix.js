const mix = require('laravel-mix');

// auth
mix .sass('resources/sass/auth/index.sass', 'public/css/auth.css')
    .version()

// admin
// mix .js('resources/js/admin/index.js', 'public/js/admin.js')
//     .sass('resources/sass/admin/index.sass', 'public/css/admin.css')
//     .version()

// vendors
mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/vendors/bootstrap.min.css')
