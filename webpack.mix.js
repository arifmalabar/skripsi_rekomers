const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js").postCss(
    "resources/css/app.css",
    "public/css",
    [
        //
    ]
);
mix.js("resources/js/manufacturing/manufacturing.js", "public/js").react();
mix.js("resources/js/manufacturing/tambahproduk.js", "public/js").react();
mix.js("resources/js/produk/produk.js", "public/js").react();
mix.js("resources/js/produk/tambahproduk.js", "public/js").react();
mix.js("resources/js/produk/updateproduk.js", "public/js").react();
mix.js("resources/js/bahan/bahan.js", "public/js").react();
mix.js("resources/js/bom/tambah_bom.js", "public/js").react();
mix.js("resources/js/bom/bom.js", "public/js").react();
mix.js("resources/js/bom/update_bom.js", "public/js").react();
