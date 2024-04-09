<?php

namespace dao;

require_once 'modelos/PedidoDetalle.php';
require_once 'util/ConexionDB.php';

use PDO;
use modelo\PedidoDetalle;
use util\ConexionDB;

class PedidoDetalleDao {

  private PDO $conexion;

  public function __construct() {
    $db = new ConexionDB();
    $this->conexion = $db->conectar();
  }

  // Método para crear un nuevo detalle de pedido
  public function crear(PedidoDetalle $pedidoDetalle) {
    $sql = "INSERT INTO detallespedido (cliente_id, producto_id, pedido_id, cantidad, nota) VALUES (:cliente_id, :producto_id, :pedido_id, :cantidad, :nota)";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':cliente_id', $pedidoDetalle->getClienteId(), \PDO::PARAM_INT);
    $stmt->bindValue(':producto_id', $pedidoDetalle->getProductoId(), \PDO::PARAM_INT);
    $stmt->bindValue(':pedido_id', $pedidoDetalle->getPedidoId(), \PDO::PARAM_INT);
    $stmt->bindValue(':cantidad', $pedidoDetalle->getCantidad(), \PDO::PARAM_INT);
    $stmt->bindValue(':nota', $pedidoDetalle->getNota(), \PDO::PARAM_STR);
    $stmt->execute();
    return $this->conexion->lastInsertId();
  }

  // Método para obtener un detalle de pedido por su ID
  public function obtenerPorId($id) {
    $sql = "SELECT dp.id AS detalle_id, dp.cliente_id, dp.producto_id, dp.pedido_id, dp.cantidad, dp.nota,
                   p.id AS pedido_id, p.fecha_pedido, p.direccion AS pedido_direccion, p.codigo_postal, p.estado,
                   c.id AS cliente_id, c.nombre AS cliente_nombre, c.identificacion AS cliente_identificacion, c.apellidos AS cliente_apellidos, c.telefono AS cliente_telefono, c.correo AS cliente_correo,
                   pr.id AS producto_id, pr.nombre AS producto_nombre, pr.descripcion AS producto_descripcion, pr.precio AS producto_precio, pr.impuestos AS producto_impuestos, pr.unidades AS producto_unidades
            FROM DetallesPedido dp
            LEFT JOIN Pedidos p ON dp.pedido_id = p.id
            LEFT JOIN Cliente c ON dp.cliente_id = c.id
            LEFT JOIN Productos pr ON dp.producto_id = pr.id
            WHERE dp.id = :id";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($resultado) {
        // Construir un array con la información obtenida
        $detallePedido = [
            "id" => $resultado['detalle_id'],
            "cantidad" => $resultado['cantidad'],
            "nota" => $resultado['nota'],
            "cliente" => [
                "id" => $resultado['cliente_id'],
                "nombre" => $resultado['cliente_nombre'],
                "identificacion" => $resultado['cliente_identificacion'],
                "apellidos" => $resultado['cliente_apellidos'],
                "telefono" => $resultado['cliente_telefono'],
                "correo" => $resultado['cliente_correo']
            ],
            "pedido" => [
                "id" => $resultado['pedido_id'],
                "fecha_pedido" => $resultado['fecha_pedido'],
                "direccion" => $resultado['pedido_direccion'],
                "codigo_postal" => $resultado['codigo_postal'],
                "estado" => $resultado['estado']
            ],
            "producto" => [
                "id" => $resultado['producto_id'],
                "nombre" => $resultado['producto_nombre'],
                "descripcion" => $resultado['producto_descripcion'],
                "precio" => $resultado['producto_precio'],
                "impuestos" => $resultado['producto_impuestos'],
                "unidades" => $resultado['producto_unidades']
            ],
        ];

        return $detallePedido;
    } else {
        return null;
    }
}


  // Método para obtener todos los detalles de pedido
  public function obtenerTodos() {
    $sql = "SELECT * FROM detallespedido";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $resultados;
  }

  // Método para actualizar un detalle de pedido
  public function actualizar(PedidoDetalle $pedidoDetalle) {
    $sql = "UPDATE detallespedido SET cliente_id = :cliente_id, producto_id = :producto_id, pedido_id = :pedido_id, cantidad = :cantidad, nota = :nota WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $pedidoDetalle->getId(), \PDO::PARAM_INT);
    $stmt->bindValue(':cliente_id', $pedidoDetalle->getClienteId(), \PDO::PARAM_INT);
    $stmt->bindValue(':producto_id', $pedidoDetalle->getProductoId(), \PDO::PARAM_INT);
    $stmt->bindValue(':pedido_id', $pedidoDetalle->getPedidoId(), \PDO::PARAM_INT);
    $stmt->bindValue(':cantidad', $pedidoDetalle->getCantidad(), \PDO::PARAM_INT);
    $stmt->bindValue(':nota', $pedidoDetalle->getNota(), \PDO::PARAM_STR);
    return $stmt->execute();
  }

  // Método para eliminar un detalle de pedido
  public function eliminar($id) {
    $sql = "DELETE FROM detallespedido WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    return $stmt->execute();
  }
}

?>
