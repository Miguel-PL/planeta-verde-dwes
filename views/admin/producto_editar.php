<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título del formulario -->
    <h2 class="my-4">Editar producto</h2>

    <!-- Formulario de edición de producto -->
    <form method="post"
          enctype="multipart/form-data"
          action="index.php?controller=producto&action=actualizar">

        <!-- Id del producto -->
        <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">

        <!-- Imagen actual del producto -->
        <input type="hidden" name="imagen_actual" value="<?= $producto['imagen'] ?>">

        <!-- Campo nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control"
                   value="<?= htmlspecialchars($producto['nombre']) ?>" required>
        </div>

        <!-- Campo descripción -->
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
        </div>

        <!-- Campo precio -->
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control"
                   value="<?= $producto['precio'] ?>" required>
        </div>

        <!-- Selector de categoría -->
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="id_categoria" class="form-select" required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>"
                        <?= $cat['id_categoria'] == $producto['id_categoria'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Imagen actual y subida opcional -->
        <div class="mb-3">
            <label class="form-label">Imagen (opcional)</label><br>
            <img src="public/img/<?= htmlspecialchars($producto['imagen']) ?>"
                 class="img-fluid mb-2" style="max-width: 150px;">
            <input type="file" name="imagen" class="form-control">
        </div>

        <!-- Botón de envío -->
        <button class="btn btn-success">Guardar cambios</button>
    </form>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

