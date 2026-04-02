<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Mi perfil</h2>

    <form method="POST" action="index.php?controller=usuario&action=actualizarPerfil" class="card p-4 shadow-sm">

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

        <button type="submit" class="btn btn-success">
            Guardar cambios
        </button>

    </form>
    <hr>

    <form method="POST" action="index.php?controller=usuario&action=bajaPerfil"
        onsubmit="return confirm('¿Estás seguro de que quieres darte de baja?');">

        <button type="submit" class="btn btn-danger">
            Darse de baja
        </button>

    </form>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>