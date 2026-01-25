<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título del pedido -->
    <h2 class="my-4">Pedido #<?= $pedido['id_pedido'] ?></h2>

    <!-- Información general del pedido -->
    <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['cliente'] ?? 'Invitado') ?></p>
    <p><strong>Fecha:</strong> <?= $pedido['created_at'] ?></p>
    <p><strong>Total:</strong> <?= number_format($pedido['total'], 2) ?> €</p>

    <!-- Formulario para cambiar el estado del pedido -->
    <form method="post"
        action="index.php?controller=pedido&action=cambiarEstado"
        class="d-flex gap-2 mb-3">

        <!-- Id del pedido -->
        <input type="hidden"
            name="id_pedido"
            value="<?= $pedido['id_pedido'] ?>">

        <!-- Selector de estado -->
        <select name="estado" class="form-select form-select-sm">
            <option value="pendiente" <?= $pedido['estado'] === 'pendiente' ? 'selected' : '' ?>>
                Pendiente
            </option>
            <option value="enviado" <?= $pedido['estado'] === 'enviado' ? 'selected' : '' ?>>
                Enviado
            </option>
            <option value="entregado" <?= $pedido['estado'] === 'entregado' ? 'selected' : '' ?>>
                Entregado
            </option>
        </select>

        <!-- Botón de actualización -->
        <button class="btn btn-sm btn-success">
            Actualizar estado
        </button>
    </form>

    <!-- Detalle del pedido -->
    <h4>Detalle del pedido</h4>

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
