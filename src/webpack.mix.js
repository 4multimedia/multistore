let mix = require('laravel-mix');
require('mix-tailwindcss');

mix.vue();
mix.js('Core/resources/js/app.js', 'js/backend.js').setPublicPath('../../../public');
mix.postCss('Core/resources/css/app.css', 'css/backend.css').setPublicPath('../../../public').tailwind();

// DODATKOWE CSS
