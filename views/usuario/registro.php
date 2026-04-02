<?php require_once __DIR__ . "/../partials/header.php"; ?>
<?php require_once __DIR__ . "/../partials/navbar.php"; ?>

<main class="container flex-fill">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <h2 class="mb-4 text-center">Crear cuenta</h2>

            <form method="post"
                action="index.php?controller=usuario&action=guardarRegistro"
                class="card p-4 shadow-sm">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" name="dni" id="dni" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-success w-100">
                    Registrarse
                </button>
            </form>

        </div>
    </div>
</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>