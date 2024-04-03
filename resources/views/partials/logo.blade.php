<?php

//Set the content-type header and charset.
header('Content-Type: text/css; charset=utf-8');

if (isset($_SESSION['primary_color']) && isset($_SESSION['secondary_color'])) {
    $primary_color = $_SESSION['primary_color'];
    $secondary_color = $_SESSION['secondary_color'];
} else {
    $primary_color = '#2D2A78';
    $secondary_color = '#2D2A78';
}

?>

<style>
    /* Estilos para las fuentes personalizadas */
    @import url('https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@300;400;700&family=Open+Sans:wght@300;400;700&display=swap');

    /* Estilo para el encabezado h1 */
    .logo-awdit {
        font-family: 'Baloo Bhaijaan 2', sans-serif;
        font-size: {{ $fontSize ?? '5em' }};
        color: {{ $primary_color }};
    }
</style>

<h1 class="logo-awdit">Awdit</h1>
