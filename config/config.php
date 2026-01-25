<?php

// Detecta si el proyecto se ejecuta en local o en producción
if ($_SERVER['HTTP_HOST'] === 'localhost') {

    // URL base del proyecto en entorno local
    define('BASE_URL', 'http://localhost/planeta_verde/');

} else {

    // URL base del proyecto en el servidor online
    define('BASE_URL', 'https://planetaverde.infinityfreeapp.com/');
}


