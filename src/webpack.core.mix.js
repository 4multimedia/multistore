let mix = require('laravel-mix');

mix.vue();
mix.js('Core/resources/js/app.js', 'public/js/backend.js')
.js('Core/resources/js/web/app.js', 'public/js/web.js')
.postCss('Core/resources/css/app.css', 'public/css/backend.css', [ require('tailwindcss') ])
.postCss('Core/resources/css/visual.css', 'public/css/backend.visual.css');
