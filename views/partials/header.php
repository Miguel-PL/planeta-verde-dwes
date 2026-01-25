<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Planeta Verde</title>

    <!-- Carga de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/estilos.css">

</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    // Carga del sistema de mensajes flash
    require_once __DIR__ . '/../../config/flash.php';
    $flash = getFlash();
    ?>

    <?php if ($flash): ?>
        <!-- Mensaje flash -->
        <div class="container mt-3">
            <div class="alert alert-<?= $flash['tipo'] ?>">
                <?= htmlspecialchars($flash['mensaje']) ?>
            </div>
        </div>
    <?php endif; ?>
