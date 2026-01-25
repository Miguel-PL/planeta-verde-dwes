<?php

// Autoload manual de Stripe (equivalente a Composer)
spl_autoload_register(function ($class) {

    // Solo cargar clases del namespace Stripe
    if (strpos($class, 'Stripe\\') !== 0) {
        return;
    }

    $baseDir = __DIR__ . '/';

    // Convertir namespace a ruta de archivo
    $relativeClass = substr($class, strlen('Stripe\\'));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
