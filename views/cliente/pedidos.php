<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container flex-fill">
    
    <!-- Título de la sección -->
    <h2 class="my-4">Mis pedidos</h2>

    <!-- Mensaje si no hay pedidos -->
    <?php if (empty($pedidos)): ?>
        <p>No has realizado ningún pedido.</p>
    <?php else: ?>
        <!-- Tabla de pedidos del cliente -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $p): ?>
                    <tr>
                        <td><?= $p['id_pedido'] ?></td>
                        <td><?= $p['created_at'] ?></td>
                        <td><?= number_format($p['total'], 2) ?> €</td>
                        <td><?= ucfirst($p['estado']) ?></td>
                        <td>
                            <!-- Enlace al detalle del pedido -->
                            <a href="index.php?controller=cliente&action=verPedido&id=<?= $p['id_pedido'] ?>"
                                class="btn btn-sm btn-primary">
                                Ver
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
