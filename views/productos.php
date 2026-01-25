<?php require_once __DIR__ . "/partials/header.php"; ?>

<?php require_once __DIR__ . "/partials/navbar.php"; ?>

<main class="container flex-fill">

    <!-- Texto de resultados de búsqueda -->
    <?php if (!empty($_GET['q'])): ?>
        <p class="text-muted">
            Resultados de búsqueda para:
            <strong><?= htmlspecialchars($_GET['q']) ?></strong>
        </p>
    <?php endif; ?>

    <div class="row">
        
        <!-- Mensaje si no hay productos -->
        <?php if (empty($productos)): ?>
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

                        <!-- Precio y formulario para añadir al carrito -->
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

</main>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
</body>

</html>
