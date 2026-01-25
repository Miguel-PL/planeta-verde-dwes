<?php

// Guarda un mensaje flash en la sesión
function setFlash($tipo, $mensaje) {
    $_SESSION['flash'] = [
        'tipo' => $tipo,      
        'mensaje' => $mensaje
    ];
}

// Obtiene y elimina el mensaje flash de la sesión
function getFlash() {
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

