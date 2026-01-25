<?php
// Carga funciones de autenticación
require_once __DIR__ . '/../../config/auth.php';

// Calcula el total de productos del carrito
$totalCarrito = 0;
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $totalCarrito += $item['cantidad'];
    }
}
?>

<!-- Barra de navegación principal -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php?controller=home&action=index">
            Planeta Verde
        </a>

        <!-- Botón menú móvil -->
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">

                <!-- Enlace a administración -->
                <?php if (esEmpleado()): ?>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="index.php?controller=admin&action=index">
                            Administración
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Enlace inicio -->
                <li class="nav-item">
                    <a class="nav-link"
                        href="index.php?controller=home&action=index">
                        Inicio
                    </a>
                </li>

                <!-- Enlace productos -->
                <li class="nav-item">
                    <a class="nav-link"
                        href="index.php?controller=producto&action=index">
                        Productos
                    </a>
                </li>

                <!-- Enlace contacto -->
                <li class="nav-item">
                    <a class="nav-link"
                        href="index.php?controller=contacto&action=index">
                        Contacto
                    </a>
                </li>

                <!-- Enlace pedidos del cliente -->
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="index.php?controller=cliente&action=pedidos">
                            Mis pedidos
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Enlace carrito -->
                <li class="nav-item">
                    <a class="nav-link"
                        href="index.php?controller=carrito&action=index">
                        Carrito
                        <?php if ($totalCarrito > 0): ?>
                            <span class="badge bg-light text-success ms-1">
                                <?= $totalCarrito ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>

                <!-- Usuario autenticado -->
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">
                            <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item"
                                    href="index.php?controller=login&action=logout">
                                    Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- Enlace login -->
                    <li class="nav-item">
                        <a class="nav-link"
                            href="index.php?controller=login&action=index">
                            Login
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<!-- Barra de categorías -->
<?php if (!empty($categorias)): ?>
    <div class="bg-success-subtle border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-2">

                <!-- Listado de categorías -->
                <ul class="nav">
                    <?php foreach ($categorias as $categoria): ?>
                        <?php
                        $activa = ($idCategoria ?? null) == $categoria['id_categoria'];
                        ?>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold
                   <?= $activa ? 'text-white bg-success rounded px-2' : 'text-success' ?>"
                                href="index.php?controller=producto&action=index&id_categoria=<?= $categoria['id_categoria'] ?>">
                                <?= htmlspecialchars($categoria['nombre']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Buscador de productos -->
                <form method="get"
                    action="index.php"
                    class="d-flex"
                    role="search">

                    <input type="hidden" name="controller" value="producto">
                    <input type="hidden" name="action" value="index">

                    <input class="form-control form-control-xl me-2"
                        type="search"
                        name="q"
                        placeholder="Buscar productos…"
                        value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">

                    <button class="btn btn-outline-success btn-sm">
                        Buscar
                    </button>
                </form>

            </div>

        </div>
    </div>
<?php endif; ?>

<!-- Descripción de categoría -->
<?php if (!empty($mostrarDescripcionCategoria)): ?>

    <?php if (!empty($categoriaActual)): ?>
        <div class="bg-light border-bottom py-3 mb-4">
            <div class="container">
                <p class="mb-0 text-muted">
                    <?= htmlspecialchars($categoriaActual['descripcion']) ?>
                </p>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-light border-bottom py-3 mb-4">
            <div class="container">
                <p class="mb-0 text-muted">
                    Productos ecológicos seleccionados para ti 
                </p>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>
