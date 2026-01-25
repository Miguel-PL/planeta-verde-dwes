<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título del formulario -->
    <h2 class= "my-4">Nuevo producto</h2>

    <!-- Formulario de creación de producto -->
    <form method="post"
        enctype="multipart/form-data"
        action="index.php?controller=producto&action=guardar">

        <!-- Campo nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <!-- Campo descripción -->
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion"
                class="form-control"
                rows="3"
                required></textarea>
        </div>

        <!-- Campo precio -->
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" required>
        </div>

        <!-- Selector de categoría -->
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="id_categoria" class="form-select" required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>">
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Campo imagen -->
        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <!-- Botón de envío -->
        <button class="btn btn-success">Guardar</button>
    </form>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
