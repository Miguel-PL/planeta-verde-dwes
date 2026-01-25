<?php

// Carga el modelo de categorías
require_once __DIR__ . '/../models/Categoria.php';

// Carga el modelo de productos
require_once __DIR__ . '/../models/Producto.php';

class HomeController
{

    // Muestra la página principal
    public function index()
    {

        // Obtiene las categorías activas
        $categorias = Categoria::getAllActivas();

        // Obtiene una selección de productos destacados
        $productos = array_slice(Producto::getAll(), 0, 6);

        // Carga la vista de inicio
        require_once __DIR__ . '/../views/home.php';
    }
}

