<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Editar usuario</h2>

    <form method="POST" action="index.php?controller=usuario&action=actualizar" class="card p-4 shadow-sm">

        <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control"
                   value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">DNI</label>
            <input type="text" name="dni" class="form-control"
                   value="<?= htmlspecialchars($usuario['dni'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="index.php?controller=usuario&action=admin" class="btn btn-secondary">
                Volver
            </a>

            <button type="submit" class="btn btn-success">
                Guardar cambios
            </button>
        </div>

    </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>