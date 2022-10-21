let mix = require('laravel-mix');

mix.vue();
mix.js('Core/resources/js/app.js', 'js/backend.js').setPublicPath('../../../../public');

// DODATKOWE CSS
