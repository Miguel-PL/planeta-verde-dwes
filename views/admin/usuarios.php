<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>

<main class="container">

    <!-- Título de la sección -->
    <h2 class="my-4">Usuarios</h2>

    <!-- Formulario de filtros -->
    <form method="get" class="row g-2 mb-4">

        <!-- Parámetros del controlador -->
        <input type="hidden" name="controller" value="usuario">
        <input type="hidden" name="action" value="admin">

        <!-- Filtro por nombre o email -->
        <div class="col-md-4">
            <input type="search"
                name="q"
                class="form-control"
                placeholder="Buscar por nombre o email"
                value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        </div>

        <!-- Filtro por rol -->
        <div class="col-md-3">
            <select name="rol" class="form-select">
                <option value="">Todos los roles</option>
                <option value="cliente" <?= ($_GET['rol'] ?? '') === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                <option value="empleado" <?= ($_GET['rol'] ?? '') === 'empleado' ? 'selected' : '' ?>>Empleado</option>
                <option value="admin" <?= ($_GET['rol'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <!-- Botón de filtrado -->
        <div class="col-md-2">
            <button class="btn btn-success w-100">Filtrar</button>
        </div>

    </form>

    <!-- Tabla de usuarios -->
    <table class="table table-striped mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['nombre']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>

                    <!-- Columna de rol -->
                    <td>
                        <?php if ($u['id_usuario'] == $_SESSION['usuario']['id']): ?>
                            <?= $u['rol'] ?>
                        <?php else: ?>
                            <!-- Formulario para cambiar rol -->
                            <form method="post"
                                action="index.php?controller=usuario&action=cambiarRol"
                                class="d-inline">
                                <input type="hidden" name="id" value="<?= $u['id_usuario'] ?>">
                                <select name="rol"
                                    onchange="this.form.submit()"
                                    class="form-select form-select-sm d-inline w-auto">
                                    <option value="cliente" <?= $u['rol'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
                                    <option value="empleado" <?= $u['rol'] == 'empleado' ? 'selected' : '' ?>>Empleado</option>
                                </select>
                            </form>
                        <?php endif; ?>
                    </td>

                    <!-- Estado del usuario -->
                    <td><?= $u['activo'] ? 'Activo' : 'Inactivo' ?></td>

                    <!-- Acciones del usuario -->
                    <td>
                        <?php if ($u['id_usuario'] != $_SESSION['usuario']['id']): ?>
                            <?php if ($u['activo']): ?>
                                <a href="index.php?controller=usuario&action=desactivar&id=<?= $u['id_usuario'] ?>"
                                    class="btn btn-sm btn-danger">
                                    Desactivar
                                </a>
                            <?php else: ?>
                                <a href="index.php?controller=usuario&action=activar&id=<?= $u['id_usuario'] ?>"
                                    class="btn btn-sm btn-success">
                                    Activar
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
