<?php

namespace controlador;

require_once 'modelos/Cliente.php';
require_once 'dao/ClienteDao.php';

use modelo\Cliente;
use dao\ClienteDao;

class ClienteControlador
{

    private $clienteDao;

    public function __construct()
    {
        $this->clienteDao = new ClienteDao();
    }

    // Acción para crear un nuevo cliente**
    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'error' => 'Método no permitido'
            ]);
        }

        $requestData = json_decode(file_get_contents('php://input'), true);

        $nombre = $requestData['nombre'];
        $identificacion = $requestData['identificacion'];
        $apellidos = $requestData['apellidos'];
        $telefono = $requestData['telefono'];
        $correo = $requestData['correo'];

        $cliente = new Cliente(null, $nombre, $identificacion, $apellidos, $telefono, $correo);

        $id = $this->clienteDao->crear($cliente);

        echo json_encode([
            'status' => 'success',
            'id' => $id
        ]);
    }

    // Acción para obtener un cliente por su ID**
    public function obtenerPorId()
    {
        $id = $_GET['id'];

        $cliente = $this->clienteDao->obtenerPorId($id);

        if ($cliente) {
            echo json_encode($cliente);
        } else {
            echo json_encode([
                'error' => 'Cliente no encontrado'
            ]);
        }
    }

    // Acción para obtener todos los clientes**
    public function obtenerTodos()
    {
        $clientes = $this->clienteDao->obtenerTodos();

        echo json_encode($clientes);
    }

    // Acción para actualizar un cliente**
    public function actualizar()
    {
        $id = $_GET['id'];

        $requestData = json_decode(file_get_contents('php://input'), true);

        $nombre = $requestData['nombre'];
        $identificacion = $requestData['identificacion'];
        $apellidos = $requestData['apellidos'];
        $telefono = $requestData['telefono'];
        $correo = $requestData['correo'];

        $cliente = new Cliente($id, $nombre, $identificacion, $apellidos, $telefono, $correo);

        if($this->clienteDao->actualizar($cliente)){
            echo json_encode([
                'status' => 'success'
            ]);
        } else {
            echo json_encode([
                'error' => 'No se pudo actualizar el cliente'
            ]);
        }
    }

    // Acción para eliminar un cliente**
    public function eliminar()
    {
        $id = $_GET['id'];

        if ($this->clienteDao->eliminar($id)) {
            echo json_encode([
                'status' => 'success'
            ]);
            return;
        }

        echo json_encode([
            'error' => 'No se pudo eliminar el cliente'
        ]);
    }
}
