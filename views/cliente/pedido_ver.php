<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título del pedido -->
    <h2 class="my-4">Pedido #<?= $pedido['id_pedido'] ?></h2>

    <!-- Información general del pedido -->
    <p><strong>Fecha:</strong> <?= $pedido['created_at'] ?></p>
    <p><strong>Total:</strong> <?= number_format($pedido['total'], 2) ?> €</p>
    <p><strong>Estado:</strong> <?= ucfirst($pedido['estado']) ?></p>

    <!-- Detalle del pedido -->
    <h4>Detalle</h4>

    <ul class="list-group">
        <?php foreach ($detalle as $d): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= htmlspecialchars($d['nombre']) ?>
                <span>
                    <?= $d['cantidad'] ?> × <?= number_format($d['precio_unitario'], 2) ?> €
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

