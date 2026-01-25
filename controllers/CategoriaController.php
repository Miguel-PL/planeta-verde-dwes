<?php

require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController
{

    public function index()
    {
        requireEmpleado();
        $categorias = Categoria::getAll();
        require_once __DIR__ . '/../views/admin/categorias.php';
    }

    public function crear()
    {
        requireEmpleado();
        require_once __DIR__ . '/../views/admin/categoria_crear.php';
    }

    public function guardar()
    {
        requireEmpleado();

        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = $_POST['descripcion'] ?? null;

        if ($nombre === '') {
            header('Location: index.php?controller=categoria&action=crear');
            exit;
        }

        Categoria::insertar($nombre, $descripcion);
        header('Location: index.php?controller=categoria&action=index');
        exit;
    }

    public function activar()
    {
        requireEmpleado();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Categoria::activar($id);
        }
        header('Location: index.php?controller=categoria&action=index');
        exit;
    }


    public function desactivar()
    {
        requireEmpleado();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Categoria::desactivar($id);
        }
        header('Location: index.php?controller=categoria&action=index');
        exit;
    }

    public function editar()
    {
        requireEmpleado();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=categoria&action=index');
            exit;
        }

        $categoria = Categoria::getById($id);
        require_once __DIR__ . '/../views/admin/categoria_editar.php';
    }

    public function actualizar()
    {
        requireEmpleado();

        $id = $_POST['id'] ?? null;
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = $_POST['descripcion'] ?? null;

        if (!$id || $nombre === '') {
            header('Location: index.php?controller=categoria&action=index');
            exit;
        }

        Categoria::actualizar($id, $nombre, $descripcion);

        header('Location: index.php?controller=categoria&action=index');
        exit;
    }
}
