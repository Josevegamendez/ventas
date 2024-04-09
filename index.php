<?php

require_once 'controladores/ClienteControlador.php';
require_once 'controladores/ProductoControlador.php';
require_once 'controladores/PedidoControlador.php';
require_once 'controladores/PedidoDetalleControlador.php';


header('Content-Type: application/json');

// Array de rutas
$rutas = array(
    "GET" => array(
        "Cliente" => array(
            "index" => "obtenerTodos",
            "read" => "obtenerPorId"
        ),
        "Producto" => array(
            "index" => "obtenerTodos",
            "read" => "obtenerPorId"
        ),
        "Pedido" => array(
            "index" => "obtenerTodos",
            "read" => "obtenerPorId"
        ),
        "PedidoDetalle" => array(
            "index" => "obtenerTodos",
            "read" => "obtenerPorId"
        )
    ),
    "POST" => array(
        "Cliente" => array(
            "crear" => "crear"
        ),
        "Producto" => array(
            "crear" => "crear"
        ),
        "Pedido" => array(
            "crear" => "crear"
        ),
        "PedidoDetalle" => array(
            "crear" => "crear"
        )
    ),
    "PUT" => array(
        "Cliente" => array(
            "update" => "actualizar"
        ),
        "Producto" => array(
            "update" => "actualizar"
        ),
        "Pedido" => array(
            "update" => "actualizar"
        ),
        "PedidoDetalle" => array(
            "update" => "actualizar"
        )
    ),
    "DELETE" => array(
        "Cliente" => array(
            "delete" => "eliminar"
        ),
        "Producto" => array(
            "delete" => "eliminar"
        ),
        "Pedido" => array(
            "delete" => "eliminar"
        ),
        "PedidoDetalle" => array(
            "delete" => "eliminar"
        )
    )
);


// Obtener el controlador y el método del controlador de la URL
$controlador = $_GET["controlador"];
$metodo = $_GET["metodo"];

// Validar el método HTTP
if (!isset($rutas[$_SERVER["REQUEST_METHOD"]])) {
    echo "Método HTTP no válido";
    exit;
}

// Validar si el controlador y el método existen
if (!isset($rutas[$_SERVER["REQUEST_METHOD"]][$controlador]) || !isset($rutas[$_SERVER["REQUEST_METHOD"]][$controlador][$metodo])) {
    echo "Controlador o método no válido";
    exit;
}

// Crear una instancia del controlador
$controladorClase = "controlador\\" . $controlador . "Controlador";
$controladorInstancia = new $controladorClase();

// Llamar al método del controlador
$metodoControlador = $rutas[$_SERVER["REQUEST_METHOD"]][$controlador][$metodo];
$controladorInstancia->{$metodoControlador}();
