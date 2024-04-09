<?php

namespace dao;

require_once 'modelos/Producto.php';
require_once 'util/ConexionDB.php';

use PDO;
use modelo\Producto;
use util\ConexionDB;

class ProductoDao {

  private PDO $conexion;

  public function __construct() {
    $db = new ConexionDB();
    $this->conexion = $db->conectar();
  }

  // Método para crear un nuevo producto
  public function crear(Producto $producto) {
    $sql = "INSERT INTO Productos (nombre, descripcion, precio, impuestos, unidades) VALUES (:nombre, :descripcion, :precio, :impuestos, :unidades)";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':nombre', $producto->getNombre(), \PDO::PARAM_STR);
    $stmt->bindValue(':descripcion', $producto->getDescripcion(), \PDO::PARAM_STR);
    $stmt->bindValue(':precio', $producto->getPrecio(), \PDO::PARAM_STR);
    $stmt->bindValue(':impuestos', $producto->getImpuestos(), \PDO::PARAM_STR);
    $stmt->bindValue(':unidades', $producto->getUnidades(), \PDO::PARAM_INT);
    $stmt->execute();
    return $this->conexion->lastInsertId();
  }

  // Método para obtener un producto por su ID
  public function obtenerPorId($id) {
    $sql = "SELECT * FROM Productos WHERE id = :id";
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

  // Método para obtener todos los productos
  public function obtenerTodos() {
    $sql = "SELECT * FROM Productos";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $resultados;
  }

  // Método para actualizar un producto
  public function actualizar(Producto $producto) {
    $sql = "UPDATE Productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, impuestos = :impuestos, unidades = :unidades WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $producto->getId(), \PDO::PARAM_INT);
    $stmt->bindValue(':nombre', $producto->getNombre(), \PDO::PARAM_STR);
    $stmt->bindValue(':descripcion', $producto->getDescripcion(), \PDO::PARAM_STR);
    $stmt->bindValue(':precio', $producto->getPrecio(), \PDO::PARAM_STR);
    $stmt->bindValue(':impuestos', $producto->getImpuestos(), \PDO::PARAM_STR);
    $stmt->bindValue(':unidades', $producto->getUnidades(), \PDO::PARAM_INT);
    return $stmt->execute();
  }

  // Método para eliminar un producto
  public function eliminar($id) {
    $sql = "DELETE FROM Productos WHERE id = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    return $stmt->execute();
  }
}
?>
