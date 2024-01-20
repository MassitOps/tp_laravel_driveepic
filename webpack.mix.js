const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('autoprefixer'),
   ])
   .babelConfig({
    "presets": ["@babel/preset-env"]
   });

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.m?js$/,
                resolve: {
                    fullySpecified: false
                }
            }
        ]
    }
});
