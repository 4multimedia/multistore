let mix = require('laravel-mix');

mix.vue();
mix.js('Core/resources/js/app.js', 'js/backend.js').setPublicPath('../../../public')
.postCss('Core/resources/css/app.css', '../../../public/css/backend.css', [ require('tailwindcss') ]);

// DODATKOWE CSS
