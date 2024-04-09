<?php

namespace controlador;

require_once 'modelos/Producto.php';
require_once 'dao/ProductoDao.php';

use modelo\Producto;
use dao\ProductoDao;

class ProductoControlador
{

    private $productoDao;

    public function __construct()
    {
        $this->productoDao = new ProductoDao();
    }

    // Acción para crear un nuevo producto
    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'error' => 'Método no permitido'
            ]);
            return;
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        $nombre = $requestData['nombre'];
        $descripcion = $requestData['descripcion'];
        $precio = $requestData['precio'];
        $impuestos = $requestData['impuestos'];
        $unidades = $requestData['unidades'];

        $producto = new Producto(null, $nombre, $descripcion, $precio, $impuestos, $unidades);

        $id = $this->productoDao->crear($producto);

        echo json_encode([
            'status' => 'success',
            'id' => $id
        ]);
    }

    // Acción para obtener un producto por su ID
    public function obtenerPorId()
    {
        $id = $_GET['id'];

        $producto = $this->productoDao->obtenerPorId($id);

        if ($producto) {
            echo json_encode($producto);
        } else {
            echo json_encode([
                'error' => 'Producto no encontrado'
            ]);
        }
    }

    // Acción para obtener todos los productos
    public function obtenerTodos()
    {
        $productos = $this->productoDao->obtenerTodos();

        echo json_encode($productos);
    }

    // Acción para actualizar un producto
    public function actualizar()
    {
        $id = $_GET['id'];

        $requestData = json_decode(file_get_contents('php://input'), true);

        $nombre = $requestData['nombre'];
        $descripcion = $requestData['descripcion'];
        $precio = $requestData['precio'];
        $impuestos = $requestData['impuestos'];
        $unidades = $requestData['unidades'];

        $producto = new Producto($id, $nombre, $descripcion, $precio, $impuestos, $unidades);

        if($this->productoDao->actualizar($producto)){
            echo json_encode([
                'status' => 'success'
            ]);
        } else {
            echo json_encode([
                'error' => 'No se pudo actualizar el producto'
            ]);
        }
    }

    // Acción para eliminar un producto
    public function eliminar()
    {
        $id = $_GET['id'];

        if ($this->productoDao->eliminar($id)) {
            echo json_encode([
                'status' => 'success'
            ]);
            return;
        }

        echo json_encode([
            'error' => 'No se pudo eliminar el producto'
        ]);
    }
}

?>
