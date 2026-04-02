<?php

// Carga las funciones de autenticación y control de acceso
require_once __DIR__ . '/../config/auth.php';

// Carga el modelo de pedidos
require_once __DIR__ . '/../models/Pedido.php';

class AdminController {

    // Muestra el panel de administración
    public function index() {

        requireEmpleado(); // empleado o admin

        $resumen = Pedido::getResumenVentas();

        require_once __DIR__ . '/../views/admin/index.php';
    }
}

