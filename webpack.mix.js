const mix = require('laravel-mix');

const path = require('path');

mix.alias({
    ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue'), 
});

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "resources/js")
            }
        }
    })
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
