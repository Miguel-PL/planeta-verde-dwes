<?php

// Carga la librería oficial de Stripe
require_once __DIR__ . '/../libs/stripe/init.php';

// Configura la clave secreta de Stripe
\Stripe\Stripe::setApiKey('sk_test_51SjzHFKo7yiFQ8P9yDmFhuny38KIvBSBIxiwOHspc9WYOEqrOqm2uIuad9KTq8XMtRHgo8ntbtdVEnXPpxgdpDUG00CjWxKgmp');

if ($_SERVER['HTTP_HOST'] !== 'localhost') {
    \Stripe\Stripe::setVerifySslCerts(false);
}

// Solo forzar el certificado CA en entorno local (XAMPP)
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    \Stripe\Stripe::setCABundlePath(
        'C:/xampp/php/extras/ssl/cacert.pem'
    );
}

