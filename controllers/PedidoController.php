<?php

// Carga las funciones de autenticación y control de acceso
require_once __DIR__ . '/../config/auth.php';

// Carga el modelo de pedidos
require_once __DIR__ . '/../models/Pedido.php';

class PedidoController
{

    // Muestra el listado de pedidos para administración
    public function admin()
    {
        requireEmpleado();

        // Obtiene el texto de búsqueda
        $q = trim($_GET['q'] ?? '');

        // Obtiene el filtro por estado
        $estado = $_GET['estado'] ?? '';

        // Aplica filtros si existen
        if ($q !== '' || $estado !== '') {
            $pedidos = Pedido::filtrarAdmin($q, $estado);
        } else {
            // Obtiene todos los pedidos
            $pedidos = Pedido::getAllAdmin();
        }

        // Carga la vista de pedidos
        require_once __DIR__ . '/../views/admin/pedidos.php';
    }

    // Muestra el detalle de un pedido
    public function ver()
    {
        requireEmpleado();

        // Obtiene el id del pedido
        $id = $_GET['id'] ?? null;

        // Redirige si no se recibe un id válido
        if (!$id) {
            header('Location: index.php?controller=pedido&action=admin');
            exit;
        }

        // Obtiene el pedido
        $pedido = Pedido::getByIdAdmin($id);

        // Obtiene el detalle del pedido
        $detalle = Pedido::getDetalle($id);

        // Carga la vista del pedido
        require_once __DIR__ . '/../views/admin/pedido_ver.php';
    }

    // Cambia el estado de un pedido
    public function cambiarEstado()
    {
        requireEmpleado();

        // Carga el sistema de mensajes flash
        require_once __DIR__ . '/../config/flash.php';

        // Obtiene el id del pedido
        $idPedido = $_POST['id_pedido'] ?? null;

        // Obtiene el nuevo estado
        $estado   = $_POST['estado'] ?? null;

        // Actualiza el estado del pedido
        if ($idPedido && $estado) {
            Pedido::actualizarEstado($idPedido, $estado);
            setFlash('success', 'Estado del pedido actualizado correctamente.');
        } else {
            setFlash('error', 'No se pudo actualizar el estado del pedido.');
        }

        // Redirige al panel de pedidos
        header('Location: index.php?controller=pedido&action=admin');
        exit;
    }
}
