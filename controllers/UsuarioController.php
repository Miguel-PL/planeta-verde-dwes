<?php

// Carga las funciones de autenticación y control de roles
require_once __DIR__ . '/../config/auth.php';

// Carga el modelo de usuarios
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{

    // Muestra el panel de administración de usuarios
    public function admin()
    {
        requireAdmin();

        // Obtiene el texto de búsqueda
        $q = trim($_GET['q'] ?? '');

        // Obtiene el filtro por rol
        $rol = $_GET['rol'] ?? '';

        // Aplica filtros si existen
        if ($q !== '' || $rol !== '') {
            $usuarios = Usuario::filtrarAdmin($q, $rol);
        } else {
            // Obtiene todos los usuarios
            $usuarios = Usuario::getAllAdmin();
        }

        // Carga la vista de usuarios
        require_once __DIR__ . '/../views/admin/usuarios.php';
    }

    // Cambia el rol de un usuario
    public function cambiarRol()
    {
        requireAdmin();

        // Obtiene el id del usuario
        $id = $_POST['id'] ?? null;

        // Obtiene el nuevo rol
        $rol = $_POST['rol'] ?? null;

        // Evita que el administrador se cambie su propio rol
        if ($id == $_SESSION['usuario']['id']) {
            header('Location: index.php?controller=usuario&action=admin');
            exit;
        }

        // Actualiza el rol si es válido
        if ($id && in_array($rol, ['cliente', 'empleado'])) {
            Usuario::actualizarRol($id, $rol);
        }

        header('Location: index.php?controller=usuario&action=admin');
        exit;
    }

    // Desactiva un usuario
    public function desactivar()
    {
        requireAdmin();
        $id = $_GET['id'] ?? null;

        // Evita desactivar al propio administrador
        if ($id && $id != $_SESSION['usuario']['id']) {
            Usuario::desactivar($id);
        }

        header('Location: index.php?controller=usuario&action=admin');
        exit;
    }

    // Activa un usuario
    public function activar()
    {
        requireAdmin();
        $id = $_GET['id'] ?? null;

        if ($id) {
            Usuario::activar($id);
        }

        header('Location: index.php?controller=usuario&action=admin');
        exit;
    }

    // Muestra el formulario de registro
    public function registro()
    {
        require_once __DIR__ . '/../views/usuario/registro.php';
    }

    // Guarda un nuevo usuario registrado
    public function guardarRegistro()
    {
        // Carga el sistema de mensajes flash
        require_once __DIR__ . '/../config/flash.php';

        // Obtiene los datos del formulario
        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Valida campos obligatorios
        if ($nombre === '' || $email === '' || $password === '') {
            setFlash('danger', 'Todos los campos son obligatorios.');
            header('Location: index.php?controller=usuario&action=registro');
            exit;
        }

        // Valida el formato del email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            setFlash('danger', 'Email no válido.');
            header('Location: index.php?controller=usuario&action=registro');
            exit;
        }

        // Valida la longitud de la contraseña
        if (strlen($password) < 6) {
            setFlash('danger', 'La contraseña debe tener al menos 6 caracteres.');
            header('Location: index.php?controller=usuario&action=registro');
            exit;
        }

        // Genera el hash seguro de la contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Registra el usuario en la base de datos
        Usuario::registrar($nombre, $email, $hash);

        // Realiza login automático tras el registro
        $usuario = Usuario::getByEmail($email);

        $_SESSION['usuario'] = [
            'id' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol']
        ];

        setFlash('success', 'Registro completado correctamente. Bienvenido a Planeta Verde.');
        header('Location: index.php');
        exit;
    }
}
