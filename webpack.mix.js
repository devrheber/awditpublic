const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .options({
        processCssUrls: false // Evita que Laravel Mix resuelva las URLs relativas
    })
    .browserSync({
        proxy: "http://127.0.0.1:8000", // Cambia por la URL de tu proyecto de Laravel
        files: [
            "public/**/*.(css|js)", // Agrega aquí los archivos que quieres que BrowserSync monitoree
            "resources/views/**/*.blade.php" // Agrega aquí las vistas que quieres que BrowserSync monitoree
        ]
    });

mix.styles(
    "public/css/client/css/style.php",
    "public/css/client/css/app.css"
).version(); // Agrega una versión

