<?php require_once __DIR__ . "/partials/header.php"; ?>
<?php require_once __DIR__ . "/partials/navbar.php"; ?>

<?php
// Obtiene el carrito desde la sesión
$carrito = $_SESSION['carrito'] ?? [];
?>

<main class="container flex-fill">

    <h2 class="my-4">Carrito</h2>

    <?php if (empty($carrito)): ?>
        <!-- Mensaje si el carrito está vacío -->
        <div class="alert alert-info">Tu carrito está vacío.</div>
    <?php else: ?>
        <?php
        // Calcula el total de unidades del carrito
        $totalCarrito = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $totalCarrito += $item['cantidad'];
            }
        }
        ?>

        <ul class="list-group mb-3">
            <?php
            // Inicializa el total del pedido
            $total = 0;

            foreach ($carrito as $producto):

                // Calcula el subtotal del producto
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;
            ?>
                <li class="list-group-item">

                    <div class="d-flex justify-content-between align-items-center">

                        <!-- Muestra nombre y precio del producto -->
                        <div>
                            <strong><?= htmlspecialchars($producto['nombre']) ?></strong><br>
                            <small class="text-muted">
                                <?= $producto['cantidad'] ?> × <?= number_format($producto['precio'], 2) ?> €
                            </small>
                        </div>

                        <!-- Controles del producto -->
                        <div class="d-flex align-items-center gap-3">

                            <!-- Formulario para actualizar cantidad -->
                            <form method="post"
                                action="index.php?controller=carrito&action=update"
                                class="d-flex align-items-center gap-2 mb-0">

                                <input type="hidden"
                                    name="id"
                                    value="<?= $producto['id'] ?>">

                                <input type="number"
                                    name="cantidad"
                                    value="<?= $producto['cantidad'] ?>"
                                    min="1"
                                    class="form-control form-control-sm"
                                    style="width: 70px;">

                                <button class="btn btn-sm btn-outline-success">
                                    Actualizar
                                </button>
                            </form>

                            <!-- Subtotal del producto -->
                            <strong class="text-nowrap">
                                <?= number_format($subtotal, 2) ?> €
                            </strong>

                            <!-- Enlace para quitar producto -->
                            <a href="index.php?controller=carrito&action=remove&id=<?= $producto['id'] ?>"
                                class="btn btn-sm btn-danger">
                                Quitar
                            </a>

                        </div>

                    </div>

                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Tarjeta con el total del pedido -->
        <div class="d-flex justify-content-end mb-3">
            <div class="card" style="min-width: 300px;">
                <div class="card-body">

                    <h5 class="card-title mb-3">
                        <b>Total del pedido</b>
                    </h5>

                    <div class="d-flex justify-content-between">
                        <span></span>
                        <strong class="fs-5">
                            <?= number_format($total, 2) ?> €
                        </strong>
                    </div>

                </div>
            </div>
        </div>

        <!-- Botón para finalizar la compra -->
        <div class="d-flex justify-content-end">
            <a href="index.php?controller=pago&action=checkout"
                class="btn btn-success">
                Finalizar compra
            </a>
        </div>

    <?php endif; ?>
</main>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
