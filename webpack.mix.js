const mix = require('laravel-mix');

// mai
mix .sass('resources/sass/mai/index.sass', 'public/css/mai.css')
    .version()

// auth
mix .sass('resources/sass/auth/index.sass', 'public/css/auth.css')
    .version()

// admin
mix .js('resources/js/admin/index.js', 'public/js/admin.js')
    .sass('resources/sass/admin/index.sass', 'public/css/admin.css')
    .version()

// modules
mix .js([
        'resources/js/modules/event-calendar.js'
    ], 'public/js/modules')
    .version()

// helpers
mix .js([
        'resources/js/helpers/input-mask.js'
    ], 'public/js/helpers')
    .version()

// vendors
mix.copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/css/vendors/font-awesome.min.css')
mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/vendors/bootstrap.min.css')
mix.copy('node_modules/fullcalendar/main.min.css', 'public/css/vendors/fullcalendar.min.css')
mix.copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js/vendors/bootstrap.min.js')
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/vendors/jquery.min.js')
mix.copy('node_modules/datatables.net/js/jquery.dataTables.min.js', 'public/js/vendors/jquery.dataTables.min.js')
mix.copy('node_modules/popper.js/dist/umd/popper.min.js', 'public/js/vendors/popper.min.js')
mix.copy('node_modules/moment/min/moment.min.js', 'public/js/vendors/moment.min.js')
mix.copy('node_modules/fullcalendar/main.min.js', 'public/js/vendors/fullcalendar.min.js')
mix.copy('node_modules/chart.js/dist/chart.min.js', 'public/js/vendors/chart.min.js')
