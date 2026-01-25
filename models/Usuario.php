<?php

// Carga la función de conexión a la base de datos
require_once __DIR__ . '/../config/conectar_bd.php';

class Usuario
{

    // Obtiene un usuario por su email
    public static function getByEmail($email)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de usuario por email
        $sql = "
            SELECT id_usuario, nombre, email, password, rol, activo
            FROM usuarios
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);

        // Devuelve el usuario
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtiene todos los usuarios
    public static function getAll()
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de todos los usuarios
        $sql = "
        SELECT id_usuario, nombre, email, rol, activo
        FROM usuarios
        ORDER BY nombre
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Devuelve los usuarios
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualiza el rol de un usuario
    public static function actualizarRol($id, $rol)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de actualización de rol
        $sql = "
        UPDATE usuarios
        SET rol = :rol
        WHERE id_usuario = :id
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':rol' => $rol,
            ':id' => $id
        ]);
    }

    // Desactiva un usuario
    public static function desactivar($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();
        $sql = "UPDATE usuarios SET activo = 0 WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Activa un usuario
    public static function activar($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();
        $sql = "UPDATE usuarios SET activo = 1 WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Registra un nuevo usuario
    public static function registrar($nombre, $email, $password)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de inserción de usuario
        $sql = "
        INSERT INTO usuarios (nombre, email, password, rol, activo)
        VALUES (:nombre, :email, :password, 'cliente', 1)
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':password' => $password
        ]);
    }

    // Filtra usuarios para el panel de administración
    public static function filtrarAdmin($q, $rol)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta base de usuarios
        $sql = "SELECT * FROM usuarios WHERE 1=1";
        $params = [];

        // Aplica filtro por nombre o email
        if ($q !== '') {
            $sql .= " AND (nombre LIKE :q OR email LIKE :q)";
            $params[':q'] = '%' . $q . '%';
        }

        // Aplica filtro por rol
        if ($rol !== '') {
            $sql .= " AND rol = :rol";
            $params[':rol'] = $rol;
        }

        $sql .= " ORDER BY nombre";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // Devuelve los usuarios filtrados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene todos los usuarios para administración
    public static function getAllAdmin()
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        $sql = "SELECT * FROM usuarios ORDER BY nombre";

        $stmt = $pdo->query($sql);

        // Devuelve todos los usuarios
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

