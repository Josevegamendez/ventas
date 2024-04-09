<?php

namespace dao;

require_once 'modelos/Pedido.php';
require_once 'util/ConexionDB.php';

use PDO;
use modelo\Pedido;
use util\ConexionDB;

class PedidoDao {

  private PDO $conexion;

  public function __construct() {
    $db = new ConexionDB();
    $this->conexion = $db->conectar();
  }

  // Método para crear un nuevo pedido
  public function crear(Pedido $pedido) {
    $sql = "INSERT INTO Pedidos (fecha_pedido, direccion, codigo_postal, estado) VALUES (:fechaPedido, :direccion, :codigoPostal, :estado)";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':fechaPedido', $pedido->getFechaPedido(), \PDO::PARAM_STR);
    $stmt->bindValue(':direccion', $pedido->getDireccion(), \PDO::PARAM_STR);
    $stmt->bindValue(':codigoPostal', $pedido->getCodigoPostal(), \PDO::PARAM_STR);
    $stmt->bindValue(':estado', $pedido->getEstado(), \PDO::PARAM_STR);
    $stmt->execute();
    return $this->conexion->lastInsertId();
  }

  // Método para obtener un pedido por su ID
  public function obtenerPorId($id) {
    $sql = "SELECT * FROM Pedidos WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($resultado) {
      return $resultado ;
    } else {
      return null;
    }
  }

  // Método para obtener todos los pedidos
  public function obtenerTodos() {
    $sql = "SELECT * FROM Pedidos";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $resultados;
  }

  // Método para actualizar un pedido
  public function actualizar(Pedido $pedido) {
    $sql = "UPDATE Pedidos SET fecha_pedido = :fechaPedido, direccion = :direccion, codigo_postal = :codigoPostal, estado = :estado WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $pedido->getId(), \PDO::PARAM_INT);
    $stmt->bindValue(':fechaPedido', $pedido->getFechaPedido(), \PDO::PARAM_STR);
    $stmt->bindValue(':direccion', $pedido->getDireccion(), \PDO::PARAM_STR);
    $stmt->bindValue(':codigoPostal', $pedido->getCodigoPostal(), \PDO::PARAM_STR);
    $stmt->bindValue(':estado', $pedido->getEstado(), \PDO::PARAM_STR);
    return $stmt->execute();
  }

  // Método para eliminar un pedido
  public function eliminar($id) {
    $sql = "DELETE FROM Pedidos WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    return $stmt->execute();
  }
}

?>
