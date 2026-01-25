<?php

require_once __DIR__ . '/../models/Usuario.php';

class LoginController
{

    public function index()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    public function autenticar()
    {

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $usuario = Usuario::getByEmail($email);

        if (
            $usuario && $usuario['activo'] == 1 &&
            password_verify($password, $usuario['password'])
        ) {

            $_SESSION['usuario'] = [
                'id'   => $usuario['id_usuario'],
                'nombre' => $usuario['nombre'],
                'rol'  => $usuario['rol']
            ];

            require_once __DIR__ . '/../config/flash.php';
            setFlash('success', 'Sesión iniciada correctamente.');

            header('Location: index.php?controller=home&action=index');
            exit;
        }

        require_once __DIR__ . '/../config/flash.php';
        setFlash('danger', 'Credenciales incorrectas.');
        header('Location: index.php?controller=login&action=index');
        exit;

        require_once __DIR__ . '/../views/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }
}
