<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">
    
    <!-- Título del formulario -->
    <h2 class="my-4">Nueva categoría</h2>

    <!-- Formulario de creación de categoría -->
    <form method="post"
        action="index.php?controller=categoria&action=guardar">

        <!-- Campo nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" 
            placeholder="Nombre de la categoría" required>
        </div>

        <!-- Campo descripción -->
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion"
                class="form-control"
                rows="3"
                placeholder="Descripción de la categoría"></textarea>
        </div>

        <!-- Botón de envío -->
        <button class="btn btn-success">Guardar</button>
    </form>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
