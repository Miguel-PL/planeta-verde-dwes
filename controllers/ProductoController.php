<?php

// Carga el modelo de productos
require_once __DIR__ . '/../models/Producto.php';

// Carga el modelo de categorías
require_once __DIR__ . '/../models/Categoria.php';

// Carga las funciones de autenticación
require_once __DIR__ . '/../config/auth.php';

class ProductoController
{

    // Muestra el listado público de productos
    public function index()
    {
        // Obtiene el id de la categoría
        $idCategoria = $_GET['id_categoria'] ?? null;

        // Obtiene el texto de búsqueda
        $q = trim($_GET['q'] ?? '');

        // Obtiene las categorías activas
        $categorias = Categoria::getAllActivas();

        // Inicializa la categoría actual
        $categoriaActual = null;

        // Filtra productos por búsqueda
        if ($q !== '') {
            $productos = Producto::buscar($q);
        } elseif ($idCategoria) {
            // Filtra productos por categoría
            $categoriaActual = Categoria::getById($idCategoria);
            $productos = Producto::getByCategoria($idCategoria);
        } else {
            // Obtiene todos los productos
            $productos = Producto::getAll();
        }

        // Evita errores si no hay productos
        if (!$productos) {
            $productos = [];
        }

        // Indica si se muestra la descripción de la categoría
        $mostrarDescripcionCategoria = true;

        // Carga la vista de productos
        require_once __DIR__ . '/../views/productos.php';
    }

    // Muestra el panel de administración de productos
    public function admin()
    {
        requireEmpleado();

        // Obtiene los filtros
        $q = trim($_GET['q'] ?? '');
        $activo = $_GET['activo'] ?? '';
        $idCategoria = $_GET['id_categoria'] ?? '';

        // Obtiene todas las categorías
        $categorias = Categoria::getAll(); // para el select

        // Aplica filtros si existen
        if ($q !== '' || $activo !== '') {
            $productos = Producto::filtrarAdmin($q, $activo, $idCategoria);
        } else {
            $productos = Producto::getAllAdmin();
        }

        // Aplica filtros por búsqueda o categoría
        if ($q !== '' || $idCategoria !== '') {
            $productos = Producto::filtrarAdmin($q, $activo,$idCategoria);
        } else {
            $productos = Producto::getAllAdmin();
        }

        // Carga la vista de administración
        require_once __DIR__ . '/../views/admin/productos.php';
    }

    // Desactiva un producto
    public function desactivar()
    {
        requireEmpleado();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Producto::desactivar($id);
        }
        header('Location: index.php?controller=producto&action=admin');
        exit;
    }

    // Activa un producto
    public function activar()
    {
        requireEmpleado();
        $id = $_GET['id'] ?? null;
        if ($id) {
            Producto::activar($id);
        }
        header('Location: index.php?controller=producto&action=admin');
        exit;
    }

    // Muestra el formulario de creación de productos
    public function crear()
    {
        requireEmpleado();
        $categorias = Categoria::getAllActivas();
        require_once __DIR__ . '/../views/admin/producto_crear.php';
    }

    // Guarda un nuevo producto
    public function guardar()
    {
        requireEmpleado();

        // Obtiene los datos del formulario
        $nombre = trim($_POST['nombre'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $descripcion = trim($_POST['descripcion'] ?? '');
        $idCategoria = $_POST['id_categoria'] ?? '';

        // Valida los campos obligatorios
        if ($nombre === '' || $descripcion === '' || $precio === '' || $idCategoria === '') {
            header('Location: index.php?controller=producto&action=crear');
            exit;
        }

        // Gestiona la subida de la imagen
        $imagen = null;
        if (!empty($_FILES['imagen']['name'])) {
            $imagen = basename($_FILES['imagen']['name']);
            move_uploaded_file(
                $_FILES['imagen']['tmp_name'],
                __DIR__ . '/../public/img/' . $imagen
            );
        }

        // Inserta el producto en la base de datos
        Producto::insertar($nombre, $descripcion, $precio, $imagen, $idCategoria);
        header('Location: index.php?controller=producto&action=admin');
        setFlash('success', 'Producto guardado correctamente.');
        exit;
    }

    // Muestra el formulario de edición de productos
    public function editar()
    {
        requireEmpleado();

        // Obtiene el id del producto
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=producto&action=admin');
            exit;
        }

        // Obtiene el producto y las categorías
        $producto = Producto::getByIdAdmin($id);
        $categorias = Categoria::getAllActivas();

        // Carga la vista de edición
        require_once __DIR__ . '/../views/admin/producto_editar.php';
    }

    // Actualiza un producto existente
    public function actualizar()
    {
        requireEmpleado();

        // Obtiene los datos del formulario
        $id = $_POST['id'] ?? null;
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $idCategoria = $_POST['id_categoria'] ?? '';
        $imagenActual = $_POST['imagen_actual'] ?? null;

        // Valida los datos obligatorios
        if (!$id || $nombre === '' || $descripcion === '' || $precio === '' || $idCategoria === '') {
            header('Location: index.php?controller=producto&action=admin');
            exit;
        }

        // Gestiona la actualización de la imagen
        $imagen = $imagenActual;
        if (!empty($_FILES['imagen']['name'])) {
            $imagen = basename($_FILES['imagen']['name']);
            move_uploaded_file(
                $_FILES['imagen']['tmp_name'],
                __DIR__ . '/../public/img/' . $imagen
            );
        }

        // Actualiza el producto en la base de datos
        Producto::actualizar($id, $nombre, $descripcion, $precio, $imagen, $idCategoria);

        header('Location: index.php?controller=producto&action=admin');
        exit;
    }
}
