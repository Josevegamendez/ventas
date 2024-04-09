<?php

namespace dao;

require_once 'modelos/Cliente.php';
require_once 'modelos/PedidoDetalle.php';
require_once 'util/ConexionDB.php';

use PDO;
use modelo\Cliente;
use modelo\PedidoDetalle;
use util\ConexionDB;

class ClienteDao {

  private PDO $conexion;

  public function __construct() {
    $db = new ConexionDB();
    $this->conexion = $db->conectar();
  }

  // Método para crear un nuevo cliente**
  public function crear(Cliente $cliente) {
    $sql = "INSERT INTO Cliente (nombre, identificacion, apellidos, telefono, correo) VALUES (:nombre, :identificacion, :apellidos, :telefono, :correo)";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':nombre', $cliente->getNombre(), \PDO::PARAM_STR);
    $stmt->bindValue(':identificacion', $cliente->getIdentificacion(), \PDO::PARAM_STR);
    $stmt->bindValue(':apellidos', $cliente->getApellidos(), \PDO::PARAM_STR);
    $stmt->bindValue(':telefono', $cliente->getTelefono(), \PDO::PARAM_STR);
    $stmt->bindValue(':correo', $cliente->getCorreo(), \PDO::PARAM_STR);
    $stmt->execute();
    return $this->conexion->lastInsertId();
  }

  // Método para obtener un cliente por su ID**
  public function obtenerPorId($id) {
    $sql = "SELECT c.id AS cliente_id, c.nombre, c.identificacion, c.apellidos, c.telefono, c.correo,
                   d.id AS detalle_id, d.cliente_id AS detalle_cliente_id, d.producto_id AS detalle_producto_id, d.pedido_id AS detalle_pedido_id, d.cantidad AS detalle_cantidad, d.nota AS detalle_nota
            FROM Cliente c 
            LEFT JOIN detallespedido d ON c.id = d.cliente_id 
            WHERE c.id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($resultado) {
        // Crear array para el cliente
        $cliente = [
            "id" => $resultado['cliente_id'],
            "nombre" => $resultado['nombre'],
            "identificacion" => $resultado['identificacion'],
            'apellidos' => $resultado['apellidos'],
            'telefono' => $resultado['telefono'],
            'correo' => $resultado['correo'],
            'detalles' => []
        ];

        // Iterar sobre los resultados y agregar los detalles de pedido al array del cliente
        do {
            if ($resultado['detalle_id'] !== null) {
                // Crear array para el detalle de pedido
                $detallePedido = [
                    'id' => $resultado['detalle_id'],
                    'cliente_id' => $resultado['detalle_cliente_id'],
                    'producto_id' => $resultado['detalle_producto_id'],
                    'pedido_id' => $resultado['detalle_pedido_id'],
                    'cantidad' => $resultado['detalle_cantidad'],
                    'nota' => $resultado['detalle_nota']
                ];

                // Agregar el detalle de pedido al array de detalles del cliente
                $cliente['detalles'][] = $detallePedido;
            }
        } while ($resultado = $stmt->fetch(\PDO::FETCH_ASSOC));

        return $cliente;
    } else {
        return null;
    }
}

  // Método para obtener todos los clientes**
  public function obtenerTodos() {
    $sql = 'SELECT * FROM Cliente';
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $resultados;
  }

  // Método para actualizar un cliente**
  public function actualizar(Cliente $cliente) {
    $sql = "UPDATE Cliente SET nombre = :nombre, identificacion = :identificacion, apellidos = :apellidos, telefono = :telefono, correo = :correo WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $cliente->getId(), \PDO::PARAM_INT);
    $stmt->bindValue(':nombre', $cliente->getNombre(), \PDO::PARAM_STR);
    $stmt->bindValue(':identificacion', $cliente->getIdentificacion(), \PDO::PARAM_STR);
    $stmt->bindValue(':apellidos', $cliente->getApellidos(), \PDO::PARAM_STR);
    $stmt->bindValue(':telefono', $cliente->getTelefono(), \PDO::PARAM_STR);
    $stmt->bindValue(':correo', $cliente->getCorreo(), \PDO::PARAM_STR);
    return $stmt->execute();
  }

  // Método para eliminar un cliente**
  public function eliminar($id) {
    $sql = "DELETE FROM Cliente WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    return $stmt->execute();
  }
}
