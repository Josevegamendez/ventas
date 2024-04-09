<?php

namespace controlador;

require_once 'modelos/Pedido.php';
require_once 'dao/PedidoDao.php';

use modelo\Pedido;
use dao\PedidoDao;

class PedidoControlador
{
    private $pedidoDao;

    public function __construct()
    {
        $this->pedidoDao = new PedidoDao();
    }

    // Acción para crear un nuevo pedido
    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'error' => 'Método no permitido'
            ]);
            return;
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        $fechaPedido = $requestData['fechaPedido'];
        $direccion = $requestData['direccion'];
        $codigoPostal = $requestData['codigoPostal'];
        $estado = $requestData['estado'];

        $pedido = new Pedido(null, $fechaPedido, $direccion, $codigoPostal, $estado);

        $id = $this->pedidoDao->crear($pedido);

        echo json_encode([
            'status' => 'success',
            'id' => $id
        ]);
    }

    // Acción para obtener un pedido por su ID
    public function obtenerPorId()
    {
        $id = $_GET['id'];

        $pedido = $this->pedidoDao->obtenerPorId($id);

        if ($pedido) {
            echo json_encode($pedido);
        } else {
            echo json_encode([
                'error' => 'Pedido no encontrado'
            ]);
        }
    }

    // Acción para obtener todos los pedidos
    public function obtenerTodos()
    {
        $pedidos = $this->pedidoDao->obtenerTodos();

        echo json_encode($pedidos);
    }

    // Acción para actualizar un pedido
    public function actualizar()
    {
        $id = $_GET['id'];

        $requestData = json_decode(file_get_contents('php://input'), true);

        $fechaPedido = $requestData['fechaPedido'];
        $direccion = $requestData['direccion'];
        $codigoPostal = $requestData['codigoPostal'];
        $estado = $requestData['estado'];

        $pedido = new Pedido($id, $fechaPedido, $direccion, $codigoPostal, $estado);

        if($this->pedidoDao->actualizar($pedido)){
            echo json_encode([
                'status' => 'success'
            ]);
        } else {
            echo json_encode([
                'error' => 'No se pudo actualizar el pedido'
            ]);
        }
    }

    // Acción para eliminar un pedido
    public function eliminar()
    {
        $id = $_GET['id'];

        if ($this->pedidoDao->eliminar($id)) {
            echo json_encode([
                'status' => 'success'
            ]);
            return;
        }

        echo json_encode([
            'error' => 'No se pudo eliminar el pedido'
        ]);
    }
}

?>
