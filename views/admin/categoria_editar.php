<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título del formulario -->
    <h2 class="my-4">Editar categoría</h2>

    <!-- Formulario de edición de categoría -->
    <form method="post"
        action="index.php?controller=categoria&action=actualizar">

        <!-- Id de la categoría -->
        <input type="hidden" name="id" value="<?= $categoria['id_categoria'] ?>">

        <!-- Campo nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text"
                name="nombre"
                class="form-control"
                value="<?= htmlspecialchars($categoria['nombre']) ?>"
                required>
        </div>

        <!-- Campo descripción -->
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion"
                class="form-control"
                rows="3"><?= htmlspecialchars($categoria['descripcion']) ?></textarea>
        </div>

        <!-- Botón de envío -->
        <button class="btn btn-success">Guardar cambios</button>
    </form>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
