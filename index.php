<?php

// Inicia la sesión
session_start();

// Carga configuración general
require_once __DIR__ . '/config/config.php';

// Controlador y acción por defecto
$controller = $_GET['controller'] ?? 'home';
$action     = $_GET['action'] ?? 'index';

// Nombre de la clase del controlador
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = 'controllers/' . $controllerName . '.php';

// Comprueba que existe el controlador
if (!file_exists($controllerFile)) {
    die("El controlador $controllerName no existe");
}

// Carga el controlador
require_once $controllerFile;

// Crea la instancia del controlador
$controllerObject = new $controllerName();

// Comprueba que existe la acción
if (!method_exists($controllerObject, $action)) {
    die("La acción $action no existe en $controllerName");
}

// Ejecuta la acción solicitada
$controllerObject->$action();




