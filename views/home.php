<?php require_once __DIR__ . "/partials/header.php"; ?> 
<?php require_once __DIR__ . "/partials/navbar.php"; ?>

<main class="container flex-fill">

    <!-- Sección principal de presentación -->
    <section class="container mb-2 mt-5 py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 text-start">
                <span class="badge bg-success mb-2 p-2">100% Orgánico</span>
                <h1 class="display-5 fw-bold mb-3">Tu mercado bio, <br><span class="text-success">ahora más cerca.</span></h1>
                <p class="text-secondary mb-4">
                    En <strong>Planeta Verde</strong> seleccionamos cada producto pensando en tu salud y en el futuro del medio ambiente. Únete al cambio consciente.
                </p>

            </div>
            <div class="col-lg-6 d-none d-lg-block">

                <!-- Imagen principal -->
                <img src="<?= BASE_URL ?>public/img/logo.png"
                    alt="Logo de Planeta Verde"
                    class="img-fluid rounded-5 shadow">
            </div>
        </div>
    </section>

    <hr class="my-5">

    <!-- Bloque de login o bienvenida -->
    <section class="mb-5">
        <?php if (!isset($_SESSION['usuario'])): ?>
            <div class="alert alert-success text-center">
                <h5 class="mb-3">¿Primera vez en Planeta Verde?</h5>
                <p>
                    Regístrate o inicia sesión para guardar tus pedidos y acceder a tu historial.
                </p>
                <div class="mt-3">
                    <a href="index.php?controller=login&action=index"
                        class="btn btn-outline-success me-2">
                        Iniciar sesión
                    </a>
                    <a href="index.php?controller=usuario&action=registro"
                        class="btn btn-outline-success">
                        Registrarse
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Bienvenido de nuevo,
                <strong><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></strong>.
                ¡Gracias por confiar en Planeta Verde!
            </div>
        <?php endif; ?>
    </section>

    <hr class="my-5">

    <!-- Escaparate de productos destacados -->
    <section>
        <h3 class="mb-4 text-center">Nuestros productos destacados</h3>

        <div class="row">

            <?php if (empty($productos)): ?>
                <!-- Mensaje si no hay productos -->
                <div class="alert alert-info">
                    <?php if (!empty($_GET['q'])): ?>
                        No se han encontrado productos para
                        <strong><?= htmlspecialchars($_GET['q']) ?></strong>.
                    <?php else: ?>
                        No hay productos disponibles en esta categoría.
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php foreach ($productos as $producto): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">

                        <?php
                        // Define la imagen del producto
                        $imagen = $producto['imagen'] ?? 'default.jpg';
                        $rutaImagen = BASE_URL . 'public/img/' . $imagen;
                        ?>

                        <img src="<?= $rutaImagen ?>"
                            class="card-img-top"
                            alt="<?= htmlspecialchars($producto['nombre']) ?>">

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">
                                <?= htmlspecialchars($producto['nombre']) ?>
                            </h5>

                            <p class="card-text">
                                <?= htmlspecialchars(mb_strimwidth($producto['descripcion'], 0, 120, '…')) ?>
                            </p>

                            <!-- Precio y formulario de añadir al carrito -->
                            <div class="mt-auto d-flex align-items-center gap-3">

                                <p class="fw-bold mb-0 text-nowrap">
                                    <?= number_format($producto['precio'], 2) ?> €
                                </p>

                                <form method="post" action="index.php?controller=carrito&action=add"
                                    class="d-flex gap-2 flex-grow-1">

                                    <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">

                                    <input type="number" name="cantidad" value="1" min="1"
                                        class="form-control form-control-sm" style="width: 60px;">

                                    <button class="btn btn-success btn-sm flex-grow-1 text-nowrap">
                                        Añadir
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Enlace al catálogo completo -->
    <div class="text-center mt-4">
        <a href="index.php?controller=producto&action=index"
            class="btn btn-outline-success btn-lg">
            Ver todos los productos
        </a>
    </div>

    <hr class="my-5">

</main>

<?php require_once __DIR__ . "/partials/footer.php"; ?>

