<?php

namespace controlador;

require_once 'modelos/PedidoDetalle.php';
require_once 'dao/PedidoDetalleDao.php';

use modelo\PedidoDetalle;
use dao\PedidoDetalleDao;

class PedidoDetalleControlador
{
    private $pedidoDetalleDao;

    public function __construct()
    {
        $this->pedidoDetalleDao = new PedidoDetalleDao();
    }

    // Acción para crear un nuevo detalle de pedido
    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'error' => 'Método no permitido'
            ]);
            return;
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        $clienteId = $requestData['clienteId'];
        $productoId = $requestData['productoId'];
        $pedidoId = $requestData['pedidoId'];
        $cantidad = $requestData['cantidad'];
        $nota = $requestData['nota'];

        $pedidoDetalle = new PedidoDetalle(null, $clienteId, $productoId, $pedidoId, $cantidad, $nota);

        $id = $this->pedidoDetalleDao->crear($pedidoDetalle);

        echo json_encode([
            'status' => 'success',
            'id' => $id
        ]);
    }

    // Acción para obtener un detalle de pedido por su ID
    public function obtenerPorId()
    {
        $id = $_GET['id'];

        $pedidoDetalle = $this->pedidoDetalleDao->obtenerPorId($id);

        if ($pedidoDetalle) {
            echo json_encode($pedidoDetalle);
        } else {
            echo json_encode([
                'error' => 'Detalle de pedido no encontrado'
            ]);
        }
    }

    // Acción para obtener todos los detalles de pedido
    public function obtenerTodos()
    {
        $pedidoDetalles = $this->pedidoDetalleDao->obtenerTodos();

        echo json_encode($pedidoDetalles);
    }

    // Acción para actualizar un detalle de pedido
    public function actualizar()
    {
        $id = $_GET['id'];

        $requestData = json_decode(file_get_contents('php://input'), true);

        $clienteId = $requestData['clienteId'];
        $productoId = $requestData['productoId'];
        $pedidoId = $requestData['pedidoId'];
        $cantidad = $requestData['cantidad'];
        $nota = $requestData['nota'];

        $pedidoDetalle = new PedidoDetalle($id, $clienteId, $productoId, $pedidoId, $cantidad, $nota);

        if($this->pedidoDetalleDao->actualizar($pedidoDetalle)){
            echo json_encode([
                'status' => 'success'
            ]);
        } else {
            echo json_encode([
                'error' => 'No se pudo actualizar el detalle de pedido'
            ]);
        }
    }

    // Acción para eliminar un detalle de pedido
    public function eliminar()
    {
        $id = $_GET['id'];

        if ($this->pedidoDetalleDao->eliminar($id)) {
            echo json_encode([
                'status' => 'success'
            ]);
            return;
        }

        echo json_encode([
            'error' => 'No se pudo eliminar el detalle de pedido'
        ]);
    }
}

?>
