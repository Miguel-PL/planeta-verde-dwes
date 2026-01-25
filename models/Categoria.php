<?php

// Carga la función de conexión a la base de datos
require_once __DIR__ . '/../config/conectar_bd.php';

class Categoria
{

    // Obtiene todas las categorías activas
    public static function getAllActivas()
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de categorías activas
        $sql = "
            SELECT 
                id_categoria,
                nombre
            FROM categorias
            WHERE activo = 1
            ORDER BY nombre
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Devuelve todas las categorías activas
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene todas las categorías
    public static function getAll()
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de todas las categorías
        $sql = "
        SELECT id_categoria, nombre, activo
        FROM categorias
        ORDER BY nombre
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Devuelve todas las categorías
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta una nueva categoría
    public static function insertar($nombre, $descripcion)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de inserción
        $sql = "
        INSERT INTO categorias (nombre, descripcion, activo)
        VALUES (:nombre, :descripcion, 1)
    ";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion
        ]);
    }

    // Desactiva una categoría
    public static function desactivar($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();
        $sql = "UPDATE categorias SET activo = 0 WHERE id_categoria = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Activa una categoría
    public static function activar($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();
        $sql = "UPDATE categorias SET activo = 1 WHERE id_categoria = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Obtiene una categoría activa por su id
    public static function getById($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de categoría por id
        $sql = "
        SELECT *
        FROM categorias
        WHERE id_categoria = :id
          AND activo = 1
        LIMIT 1
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        // Devuelve la categoría
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualiza una categoría existente
    public static function actualizar($id, $nombre, $descripcion)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de actualización
        $sql = "
        UPDATE categorias
        SET nombre = :nombre,
            descripcion = :descripcion
        WHERE id_categoria = :id
    ";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':id' => $id
        ]);
    }
}

