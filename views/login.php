<?php require_once __DIR__ . "/partials/header.php"; ?>
<?php require_once __DIR__ . "/partials/navbar.php"; ?>

<main class="container flex-fill">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <!-- Título del formulario de login -->
            <h2 class="my-4 text-center">Iniciar sesión</h2>

            <!-- Formulario de inicio de sesión -->
            <form method="post"
                  action="index.php?controller=login&action=autenticar"
                  class="card p-4 shadow-sm">

                <!-- Campo email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           required>
                </div>

                <!-- Campo contraseña -->
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-success w-100">
                    Entrar
                </button>
            </form>

        </div>
    </div>
</main>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
