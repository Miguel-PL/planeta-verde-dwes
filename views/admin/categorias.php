<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título de la página -->
    <h2 class="my-4">Categorías</h2>

    <!-- Enlace para crear una nueva categoría -->
    <a href="index.php?controller=categoria&action=crear"
        class="btn btn-primary mb-3">Nueva categoría</a>

    <!-- Listado de categorías -->
    <ul class="list-group">
        <?php foreach ($categorias as $cat): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">

                <!-- Nombre y estado de la categoría -->
                <span>
                    <?= htmlspecialchars($cat['nombre']) ?>
                    <?php if (!$cat['activo']): ?>
                        <span class="badge bg-secondary ms-2">Inactiva</span>
                    <?php endif; ?>
                </span>

                <!-- Acciones de la categoría -->
                <div class="d-flex align-items-center">

                    <a href="index.php?controller=categoria&action=editar&id=<?= $cat['id_categoria'] ?>"
                        class="btn btn-sm btn-warning me-2">
                        Editar
                    </a>

                    <?php if ($cat['activo']): ?>
                        <a href="index.php?controller=categoria&action=desactivar&id=<?= $cat['id_categoria'] ?>"
                            class="btn btn-sm btn-danger">
                            Desactivar
                        </a>
                    <?php else: ?>
                        <a href="index.php?controller=categoria&action=activar&id=<?= $cat['id_categoria'] ?>"
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
