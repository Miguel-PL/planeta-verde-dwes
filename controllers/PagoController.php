<?php

// Carga la configuración de Stripe
require_once __DIR__ . '/../config/stripe.php';

// Importa la clase Session de Stripe
use Stripe\Checkout\Session;

class PagoController
{

    // Inicia el proceso de pago con Stripe
    public function checkout()
    {

        // Comprueba que el carrito no esté vacío
        if (empty($_SESSION['carrito'])) {
            header("Location: index.php?controller=carrito&action=index");
            exit;
        }

        // Inicializa el total del carrito
        $total = 0;

        // Calcula el total del carrito
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'];
        }

        // Convierte el importe a céntimos para Stripe
        $importeStripe = (int) round($total * 100);

        // Crea la sesión de pago en Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Compra en Planeta Verde',
                    ],
                    'unit_amount' => $importeStripe,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => BASE_URL . 'index.php?controller=pago&action=exito',
            'cancel_url'  => BASE_URL . 'index.php?controller=pago&action=cancelado',

        ]);

        // Redirige al usuario a la pasarela de pago
        header("Location: " . $session->url);
        exit;
    }

    // Gestiona el pago realizado correctamente
    public function exito()
    {
        // Carga el modelo de pedidos
        require_once __DIR__ . '/../models/Pedido.php';

        // Carga el sistema de mensajes flash
        require_once __DIR__ . '/../config/flash.php';

        // Redirige si no existe carrito
        if (empty($_SESSION['carrito'])) {
            header('Location: index.php');
            exit;
        }

        // Obtiene el id del usuario autenticado
        $idUsuario = $_SESSION['usuario']['id'] ?? null;

        // Obtiene el carrito desde la sesión
        $carrito   = $_SESSION['carrito'];

        // Inicializa el total del pedido
        $total = 0;

        // Calcula el total del pedido
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // Crea el pedido en la base de datos
        $idPedido = Pedido::crearPedido($idUsuario, $total, $carrito);

        // Gestiona el resultado del pedido
        if ($idPedido) {
            unset($_SESSION['carrito']);
            setFlash('success', 'Pago realizado correctamente. Pedido registrado.');
        } else {
            setFlash('danger', 'El pago se realizó, pero hubo un error al registrar el pedido.');
        }

        // Redirige al listado de pedidos del cliente
        header('Location: index.php?controller=cliente&action=pedidos');
        exit;
    }

    // Gestiona el pago cancelado
    public function cancelado()
    {
        // Carga el sistema de mensajes flash
        require_once __DIR__ . '/../config/flash.php';

        // Muestra mensaje de pago cancelado
        setFlash('warning', 'Pago cancelado. No se ha realizado ningún cargo.');

        // Redirige al carrito
        header('Location: index.php?controller=carrito&action=index');
        exit;
    }
}

