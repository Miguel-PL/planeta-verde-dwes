<?php

// Carga la función de conexión a la base de datos
require_once __DIR__ . '/../config/conectar_bd.php';

class Pedido
{

    // Crea un pedido y su detalle en una transacción
    public static function crearPedido($idUsuario, $total, $carrito)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        try {
            // Inicia la transacción
            $pdo->beginTransaction();

            // Inserta el pedido
            $sqlPedido = "
                INSERT INTO pedidos (id_usuario, total, estado, activo)
                VALUES (:id_usuario, :total, 'pendiente', 1)
            ";
            $stmtPedido = $pdo->prepare($sqlPedido);
            $stmtPedido->execute([
                ':id_usuario' => $idUsuario, // puede ser NULL
                ':total' => $total
            ]);

            // Obtiene el id del pedido creado
            $idPedido = $pdo->lastInsertId();

            // Inserta el detalle del pedido
            $sqlDetalle = "
                INSERT INTO detalle_pedido
                (id_pedido, id_producto, cantidad, precio_unitario)
                VALUES (:id_pedido, :id_producto, :cantidad, :precio)
            ";
            $stmtDetalle = $pdo->prepare($sqlDetalle);

            // Inserta cada producto del carrito
            foreach ($carrito as $item) {
                $stmtDetalle->execute([
                    ':id_pedido'   => $idPedido,
                    ':id_producto' => $item['id'],
                    ':cantidad'    => $item['cantidad'],
                    ':precio'      => $item['precio']
                ]);
            }

            // Confirma la transacción
            $pdo->commit();
            return $idPedido;
        } catch (Exception $e) {
            // Revierte la transacción en caso de error
            $pdo->rollBack();
            return false;
        }
    }

    // Obtiene todos los pedidos para administración
    public static function getAllAdmin()
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de pedidos con datos del cliente
        $sql = "
        SELECT 
            p.id_pedido,
            p.created_at,
            p.total,
            p.estado,
            u.nombre AS cliente
        FROM pedidos p
        LEFT JOIN usuarios u ON p.id_usuario = u.id_usuario
        ORDER BY p.created_at DESC
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Devuelve todos los pedidos
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene un pedido concreto para administración
    public static function getByIdAdmin($id)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de pedido por id
        $sql = "
        SELECT 
            p.id_pedido,
            p.created_at,
            p.total,
            p.estado,
            u.nombre AS cliente
        FROM pedidos p
        LEFT JOIN usuarios u ON p.id_usuario = u.id_usuario
        WHERE p.id_pedido = :id
        LIMIT 1
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        // Devuelve el pedido
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtiene el detalle de un pedido
    public static function getDetalle($idPedido)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta del detalle del pedido
        $sql = "
        SELECT 
            d.cantidad,
            d.precio_unitario,
            pr.nombre
        FROM detalle_pedido d
        JOIN productos pr ON d.id_producto = pr.id_producto
        WHERE d.id_pedido = :id
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $idPedido]);

        // Devuelve el detalle del pedido
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualiza el estado de un pedido
    public static function actualizarEstado($idPedido, $estado)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de actualización del estado
        $sql = "
        UPDATE pedidos
        SET estado = :estado
        WHERE id_pedido = :id
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':estado' => $estado,
            ':id' => $idPedido
        ]);
    }

    // Obtiene los pedidos de un usuario
    public static function getByUsuario($idUsuario)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta de pedidos por usuario
        $sql = "
        SELECT id_pedido, created_at, total, estado
        FROM pedidos
        WHERE id_usuario = :id
        ORDER BY created_at DESC
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $idUsuario]);

        // Devuelve los pedidos del usuario
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Filtra pedidos para el panel de administración
    public static function filtrarAdmin($q, $estado)
    {
        // Abre conexión con la base de datos
        $pdo = get_conexion();

        // Consulta base de pedidos
        $sql = "
        SELECT p.*, u.nombre AS cliente
        FROM pedidos p
        LEFT JOIN usuarios u ON p.id_usuario = u.id_usuario
        WHERE 1=1
    ";

        $params = [];

        // Aplica filtro por nombre de cliente
        if ($q !== '') {
            $sql .= " AND u.nombre LIKE :q";
            $params[':q'] = '%' . $q . '%';
        }

        // Aplica filtro por estado
        if ($estado !== '') {
            $sql .= " AND p.estado = :estado";
            $params[':estado'] = $estado;
        }

        $sql .= " ORDER BY p.created_at DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // Devuelve los pedidos filtrados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getResumenVentas()
    {
        $pdo = get_conexion();

        $sql = "
        SELECT 
            COUNT(*) AS total_pedidos,
            SUM(total) AS total_ingresos
        FROM pedidos
        WHERE activo = 1
        ";

        $stmt = $pdo->query($sql);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getProductosMasVendidos($limite = 5)
    {
        $pdo = get_conexion();

        $sql = "
        SELECT 
            pr.nombre,
            SUM(d.cantidad) AS total_vendidos
        FROM detalle_pedido d
        JOIN productos pr ON d.id_producto = pr.id_producto
        GROUP BY d.id_producto
        ORDER BY total_vendidos DESC
        LIMIT :limite
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getIngresosMensuales()
    {
        $pdo = get_conexion();

        $sql = "
        SELECT 
            DATE_FORMAT(created_at, '%Y-%m') AS mes,
            SUM(total) AS ingresos
        FROM pedidos
        WHERE activo = 1
        GROUP BY mes
        ORDER BY mes DESC
        ";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
