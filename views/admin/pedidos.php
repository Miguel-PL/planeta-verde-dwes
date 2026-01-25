<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título de la sección -->
    <h2 class="my-4">Pedidos</h2>

    <!-- Carga del sistema de mensajes flash -->
    <?php require_once __DIR__ . '/../../config/flash.php'; ?>

    <!-- Mensaje de éxito -->
    <?php if ($msg = getFlash('success')): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($msg) ?>
        </div>
    <?php endif; ?>

    <!-- Mensaje de error -->
    <?php if ($msg = getFlash('error')): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($msg) ?>
        </div>
    <?php endif; ?>

    <!-- Formulario de filtros -->
    <form method="get" class="row g-2 mb-4">

        <!-- Parámetros del controlador -->
        <input type="hidden" name="controller" value="pedido">
        <input type="hidden" name="action" value="admin">

        <!-- Filtro por cliente -->
        <div class="col-md-4">
            <input type="search"
                name="q"
                class="form-control"
                placeholder="Buscar por cliente"
                value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        </div>

        <!-- Filtro por estado -->
        <div class="col-md-3">
            <select name="estado" class="form-select">
                <option value="">Todos los estados</option>
                <option value="pendiente" <?= ($_GET['estado'] ?? '') === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="enviado" <?= ($_GET['estado'] ?? '') === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                <option value="entregado" <?= ($_GET['estado'] ?? '') === 'entregado' ? 'selected' : '' ?>>Entregado</option>
            </select>
        </div>

        <!-- Botón de filtrado -->
        <div class="col-md-2">
            <button class="btn btn-success w-100">Filtrar</button>
        </div>

    </form>

    <!-- Tabla de pedidos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $p): ?>
                <tr>
                    <td><?= $p['id_pedido'] ?></td>
                    <td><?= htmlspecialchars($p['cliente'] ?? 'Invitado') ?></td>
                    <td><?= $p['created_at'] ?></td>
                    <td><?= number_format($p['total'], 2) ?> €</td>
                    <td><?= ucfirst($p['estado']) ?></td>
                    <td>
                        <!-- Enlace al detalle del pedido -->
                        <a href="index.php?controller=pedido&action=ver&id=<?= $p['id_pedido'] ?>"
                            class="btn btn-sm btn-primary">
                            Ver
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
