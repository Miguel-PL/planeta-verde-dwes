<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título de la sección -->
    <h2 class="my-4">Productos</h2>

    <!-- Enlace para crear un nuevo producto -->
    <a href="index.php?controller=producto&action=crear"
        class="btn btn-primary mb-3">
        Nuevo producto
    </a>

    <!-- Formulario de filtros -->
    <form method="get" class="row g-2 mb-4">

        <!-- Parámetros del controlador -->
        <input type="hidden" name="controller" value="producto">
        <input type="hidden" name="action" value="admin">

        <!-- Filtro por texto -->
        <div class="col-md-4">
            <input type="search"
                name="q"
                value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
                class="form-control"
                placeholder="Buscar producto...">
        </div>

        <!-- Filtro por estado -->
        <div class="col-md-3">
            <select name="activo" class="form-select">
                <option value="">Todos</option>
                <option value="1" <?= ($_GET['activo'] ?? '') === '1' ? 'selected' : '' ?>>Activos</option>
                <option value="0" <?= ($_GET['activo'] ?? '') === '0' ? 'selected' : '' ?>>Inactivos</option>
            </select>
        </div>

        <!-- Filtro por categoría -->
        <div class="col-md-3">
            <select name="id_categoria" class="form-select">
                <option value="">Todas las categorías</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>"
                        <?= ($_GET['id_categoria'] ?? '') == $cat['id_categoria'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Botón de filtrado -->
        <div class="col-md-2">
            <button class="btn btn-success w-100">
                Filtrar
            </button>
        </div>

    </form>

    <!-- Listado de productos -->
    <ul class="list-group mb-4">
        <?php foreach ($productos as $p): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">

                <!-- Información del producto -->
                <div>
                    <?= htmlspecialchars($p['nombre']) ?>
                    <span class="text-muted">
                        (<?= htmlspecialchars($p['categoria']) ?> · <?= number_format($p['precio'], 2) ?> €)
                    </span>

                    <?php if (!$p['activo']): ?>
                        <span class="badge bg-secondary ms-2">Inactivo</span>
                    <?php endif; ?>
                </div>

                <!-- Acciones del producto -->
                <div class="d-flex align-items-center">
                    <a href="index.php?controller=producto&action=editar&id=<?= $p['id_producto'] ?>"
                        class="btn btn-sm btn-warning me-2">
                        Editar
                    </a>

                    <?php if ($p['activo']): ?>
                        <a href="index.php?controller=producto&action=desactivar&id=<?= $p['id_producto'] ?>"
                            class="btn btn-sm btn-danger">
                            Desactivar
                        </a>
                    <?php else: ?>
                        <a href="index.php?controller=producto&action=activar&id=<?= $p['id_producto'] ?>"
                            class="btn btn-sm btn-success">
                            Activar
                        </a>
                    <?php endif; ?>
                </div>

            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

