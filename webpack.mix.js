const mix = require('laravel-mix');
require('laravel-mix-jigsaw');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');

mix.jigsaw()
   .js('source/_assets/js/main.js', 'js').vue()
   .sass('source/_assets/scss/app.scss', 'css/app.css')
   .options({
       processCssUrls: false,
       postCss: [
           require('tailwindcss'),
       ],
   })
   .browserSync({
       server: 'build_local',
       files: ['build_local/**'],
   })
   .sourceMaps()
   .version();
