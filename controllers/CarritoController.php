<?php

// Carga el modelo de pedidos
require_once __DIR__ . '/../models/Pedido.php';

// Carga el modelo de productos
require_once __DIR__ . '/../models/Producto.php';

class CarritoController
{

    // Muestra la vista del carrito
    public function index()
    {
        require_once __DIR__ . '/../views/carrito.php';
    }

    // Añade un producto al carrito
    public function add()
    {
        // Obtiene el id del producto
        $id = $_POST['id'] ?? null;

        // Obtiene la cantidad solicitada
        $cantidad = (int) ($_POST['cantidad'] ?? 1);

        // Redirige si no se recibe un id válido
        if (!$id) {
            header('Location: index.php');
            exit;
        }

        // Obtiene el producto desde la base de datos
        $producto = Producto::getById($id);

        // Redirige si el producto no existe
        if (!$producto) {
            header('Location: index.php');
            exit;
        }

        // Inicializa el carrito en la sesión si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Aumenta la cantidad si el producto ya está en el carrito
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
        } else {
            // Añade el producto al carrito
            $_SESSION['carrito'][$id] = [
                'id'       => $producto['id_producto'],
                'nombre'   => $producto['nombre'],
                'precio'   => $producto['precio'],
                'cantidad' => $cantidad
            ];
        }

        // Vuelve a la página anterior
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
        exit;
    }

    // Redirige al proceso de pago
    public function confirmar()
    {
        header('Location: index.php?controller=pago&action=checkout');
        exit;
    }

    // Elimina un producto del carrito
    public function remove()
    {
        // Obtiene el id del producto
        $id = $_GET['id'] ?? null;

        // Elimina el producto si existe en el carrito
        if ($id && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }

        // Redirige a la vista del carrito
        header('Location: index.php?controller=carrito&action=index');
        exit;
    }

    // Actualiza la cantidad de un producto del carrito
    public function update()
    {
        // Obtiene el id del producto
        $id = $_POST['id'] ?? null;

        // Obtiene la nueva cantidad
        $cantidad = (int) ($_POST['cantidad'] ?? 1);

        // Comprueba que el producto existe en el carrito
        if ($id && isset($_SESSION['carrito'][$id])) {

            // Actualiza la cantidad o elimina el producto
            if ($cantidad > 0) {
                $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
            } else {
                unset($_SESSION['carrito'][$id]);
            }
        }

        // Redirige a la vista del carrito
        header('Location: index.php?controller=carrito&action=index');
        exit;
    }
}

