<?php

// Se incluye el archivo de configuración general del proyecto
require_once __DIR__ . '/config.php';

// Comprobamos si la aplicación se está ejecutando en entorno local
// o en un servidor online, según el dominio
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    // Datos de conexión para el entorno local (localhost)
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'planeta_verde');
    define('DB_USER', 'root');
    define('DB_PASS', '');
} else {
    // Datos de conexión para el entorno de producción (servidor online)
    define('DB_HOST', 'sql108.infinityfree.com');
    define('DB_NAME', 'if0_40705610_planeta_verde');
    define('DB_USER', 'if0_40705610');
    define('DB_PASS', 'YdIs0nWVK7');
}

// Función que crea y devuelve una conexión a la base de datos
function get_conexion()
{
    try {
        // Se construye el DSN con los datos de conexión y el charset UTF-8
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";

        // Se crea el objeto PDO para acceder a la base de datos
        $pdo = new PDO($dsn, DB_USER, DB_PASS);

        // Se configura PDO para que lance excepciones en caso de error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Se devuelve la conexión lista para ser utilizada
        return $pdo;
    } catch (PDOException $e) {
        // En caso de error, se detiene la ejecución mostrando el mensaje
        die("Error de conexión: " . $e->getMessage());
    }
}
