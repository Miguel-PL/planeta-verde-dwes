<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container flex-fill">

    <!-- Título del panel de administración -->
    <h2 class="my-4">Panel de administración</h2>

    <div class="row g-4">

        <!-- Acceso a gestión de categorías -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Categorías</h5>
                    <p class="card-text text-muted">
                        Crear y editar categorías.
                    </p>
                    <a href="index.php?controller=categoria&action=index"
                       class="btn btn-success w-100">
                        Gestionar
                    </a>
                </div>
            </div>
        </div>

        <!-- Acceso a gestión de productos -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text text-muted">
                        Alta, edición y control del catálogo.
                    </p>
                    <a href="index.php?controller=producto&action=admin"
                       class="btn btn-success w-100">
                        Gestionar
                    </a>
                </div>
            </div>
        </div>

        <!-- Acceso a gestión de pedidos -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Pedidos</h5>
                    <p class="card-text text-muted">
                        Consultar y actualizar estados.
                    </p>
                    <a href="index.php?controller=pedido&action=admin"
                       class="btn btn-success w-100">
                        Gestionar
                    </a>
                </div>
            </div>
        </div>

        <!-- Acceso a gestión de usuarios -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text text-muted">
                        Gestión de clientes y empleados.
                    </p>
                    <a href="index.php?controller=usuario&action=admin"
                       class="btn btn-success w-100">
                        Gestionar
                    </a>
                </div>
            </div>
        </div>

    </div>

</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

