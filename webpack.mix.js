const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');
/*
 |--------------------------------------------------------------------------
 | Load screen js file
 |--------------------------------------------------------------------------
 |
 | When you add js file for screen then add here.
 |
 */
const resources = [
    {
        source: "resources/js/screens/login.js",
        dest: "public/js/screens/login.js"
    },
    {
        source: "resources/js/screens/menu.js",
        dest: "public/js/screens/menu.js"
    },
    {
        source: "resources/js/screens/m0010.js",
        dest: "public/js/screens/m0010.js"
    },
    {
        source: "resources/js/screens/m0020.js",
        dest: "public/js/screens/m0020.js"
    },
    {
        source: "resources/js/screens/m0030.js",
        dest: "public/js/screens/m0030.js"
    },
    {
        source: "resources/js/screens/m0040.js",
        dest: "public/js/screens/m0040.js"
    },
    {
        source: "resources/js/screens/m0050.js",
        dest: "public/js/screens/m0050.js"
    },
    {
        source: "resources/js/screens/m0060.js",
        dest: "public/js/screens/m0060.js"
    },
    {
        source: "resources/js/screens/m0070.js",
        dest: "public/js/screens/m0070.js"
    },
    {
        source: "resources/js/screens/m0080.js",
        dest: "public/js/screens/m0080.js"
    },
    {
        source: "resources/js/screens/q0070.js",
        dest: "public/js/screens/q0070.js"
    },
    {
        source: "resources/js/screens/sS0020.js",
        dest: "public/js/screens/sS0020.js"
    },
    {
        source: "resources/js/screens/sS0030.js",
        dest: "public/js/screens/sS0030.js"
    },
]

// build js for screens
for (const value of resources) {
    // mix.js('resources/js/screens/mockup/mockup.js','public/js/screens/mockup/mockup.js');
    mix.js(value.source, value.dest);
}
// check version production
if (mix.inProduction) {
    mix.version();
}