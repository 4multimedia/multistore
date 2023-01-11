let mix = require('laravel-mix');

mix.vue();
mix.js('Core/resources/js/app.js', 'public/js/backend.js')
.postCss('Core/resources/css/app.css', 'public/css/backend.css', [ require('tailwindcss') ])
.copyDirectory('../../../vendor/tinymce/tinymce', 'public/js/tinymce');

// DODATKOWE CSS
