<?php

// Carga las funciones de autenticación
require_once __DIR__ . '/../config/auth.php';

// Carga el modelo de pedidos
require_once __DIR__ . '/../models/Pedido.php';

class ClienteController
{

    // Muestra los pedidos del usuario autenticado
    public function pedidos()
    {
        requireLogin();

        // Obtiene el id del usuario desde la sesión
        $idUsuario = $_SESSION['usuario']['id'];

        // Obtiene los pedidos del usuario
        $pedidos = Pedido::getByUsuario($idUsuario);

        // Carga la vista de pedidos del cliente
        require_once __DIR__ . '/../views/cliente/pedidos.php';
    }

    // Muestra el detalle de un pedido concreto
    public function verPedido()
    {
        requireLogin();

        // Obtiene el id del pedido
        $id = $_GET['id'] ?? null;

        // Redirige si no se recibe un id válido
        if (!$id) {
            header('Location: index.php?controller=cliente&action=pedidos');
            exit;
        }

        // Obtiene el pedido desde la base de datos
        $pedido = Pedido::getByIdAdmin($id);

        // Comprueba que el pedido pertenece al usuario autenticado
        if ($pedido['cliente'] !== $_SESSION['usuario']['nombre']) {
            header('Location: index.php?controller=cliente&action=pedidos');
            exit;
        }

        // Obtiene el detalle del pedido
        $detalle = Pedido::getDetalle($id);

        // Carga la vista del detalle del pedido
        require_once __DIR__ . '/../views/cliente/pedido_ver.php';
    }
}
