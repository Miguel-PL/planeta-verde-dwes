<?php

// Comprueba si hay un usuario autenticado en la sesión
function usuarioLogueado() {
    return isset($_SESSION['usuario']);
}

// Comprueba si el usuario autenticado tiene rol de administrador
function esAdmin() {
    return usuarioLogueado() && $_SESSION['usuario']['rol'] === 'admin';
}

// Comprueba si el usuario es empleado o administrador
function esEmpleado() {
    return usuarioLogueado() && in_array($_SESSION['usuario']['rol'], ['empleado','admin']);
}

// Obliga a iniciar sesión para acceder a una página
function requireLogin() {
    if (!usuarioLogueado()) {
        header('Location: index.php?controller=login&action=index');
        exit;
    }
}

// Restringe el acceso solo a empleados o administradores
function requireEmpleado() {
    if (!esEmpleado()) {
        header('Location: index.php');
        exit;
    }
}

// Restringe el acceso solo a administradores
function requireAdmin() {
    if (!esAdmin()) {
        header('Location: index.php');
        exit;
    }
}


