<?php

// Carga la función de conexión a la base de datos
require_once __DIR__ . '/../config/conectar_bd.php';

class Producto
{

    // Obtiene todos los productos activos
    public static function getAll()
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de productos activos
        $sql = "
        SELECT *
        FROM productos
        WHERE activo = 1
        ORDER BY nombre
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Devuelve los productos
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene todos los productos para administración
    public static function getAllAdmin()
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de productos con categoría
        $sql = "
        SELECT 
            p.id_producto,
            p.nombre,
            p.precio,
            p.activo,
            c.nombre AS categoria
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
        ORDER BY p.nombre
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Devuelve los productos
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Desactiva un producto
    public static function desactivar($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();
        $sql = "UPDATE productos SET activo = 0 WHERE id_producto = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Activa un producto
    public static function activar($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();
        $sql = "UPDATE productos SET activo = 1 WHERE id_producto = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Inserta un nuevo producto
    public static function insertar($nombre, $descripcion, $precio, $imagen, $idCategoria)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de inserción
        $sql = "
        INSERT INTO productos
        (nombre, descripcion, precio, imagen, id_categoria, activo)
        VALUES (:nombre, :descripcion, :precio, :imagen, :categoria, 1)
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':imagen' => $imagen,
            ':categoria' => $idCategoria
        ]);
    }

    // Obtiene un producto por id para administración
    public static function getByIdAdmin($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de producto por id
        $sql = "
        SELECT id_producto, nombre, descripcion, precio, imagen, id_categoria, activo
        FROM productos
        WHERE id_producto = :id
        LIMIT 1
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        // Devuelve el producto
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualiza un producto existente
    public static function actualizar($id, $nombre, $descripcion, $precio, $imagen, $idCategoria)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de actualización
        $sql = "
        UPDATE productos
        SET nombre = :nombre,
            descripcion = :descripcion,
            precio = :precio,
            imagen = :imagen,
            id_categoria = :categoria
        WHERE id_producto = :id
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':imagen' => $imagen,
            ':categoria' => $idCategoria,
            ':id' => $id
        ]);
    }

    // Obtiene productos por categoría
    public static function getByCategoria($idCategoria)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de productos por categoría
        $sql = "
        SELECT *
        FROM productos
        WHERE id_categoria = :id
          AND activo = 1
        ORDER BY nombre
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $idCategoria
        ]);

        // Devuelve los productos
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene un producto activo por id
    public static function getById($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de producto por id
        $sql = "
        SELECT *
        FROM productos
        WHERE id_producto = :id
          AND activo = 1
        LIMIT 1
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        // Devuelve el producto
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Busca productos por texto
    public static function buscar($texto)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de búsqueda de productos
        $sql = "
        SELECT *
        FROM productos
        WHERE activo = 1
          AND (
              nombre LIKE :texto
              OR descripcion LIKE :texto
          )
        ORDER BY nombre
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':texto' => '%' . $texto . '%'
        ]);

        // Devuelve los productos encontrados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Filtra productos para el panel de administración
    public static function filtrarAdmin($q, $activo, $idCategoria)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta base de productos
        $sql = "
        SELECT p.*, c.nombre AS categoria
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
        WHERE 1=1
    ";

        $params = [];

        // Aplica filtro por texto
        if ($q !== '') {
            $sql .= " AND (p.nombre LIKE :q OR p.descripcion LIKE :q)";
            $params[':q'] = '%' . $q . '%';
        }

        // Aplica filtro por estado
        if ($activo !== '') {
            $sql .= " AND p.activo = :activo";
            $params[':activo'] = $activo;
        }

        // Aplica filtro por categoría
        if ($idCategoria !== '') {
            $sql .= " AND p.id_categoria = :id_categoria";
            $params[':id_categoria'] = $idCategoria;
        }

        $sql .= " ORDER BY p.nombre";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // Devuelve los productos filtrados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

