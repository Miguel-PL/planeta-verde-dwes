<?php

// Carga la librería oficial de Stripe
require_once __DIR__ . '/../libs/stripe/init.php';

// Configura la clave secreta de Stripe
\Stripe\Stripe::setApiKey('');

// Solo forzar el certificado CA en entorno local (XAMPP)
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    \Stripe\Stripe::setCABundlePath(
        'C:/xampp/php/extras/ssl/cacert.pem'
    );
}

