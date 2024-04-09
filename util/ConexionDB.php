<?php

namespace util;

use PDO;
use PDOException;

class ConexionDB {

  private $host;
  private $usuario;
  private $contrasena;
  private $baseDatos;
  private $conexion;

  public function __construct() {
    $this->host = "localhost";
    $this->usuario = "root";
    $this->contrasena = "";
    $this->baseDatos = "ventas";
  }

  public function conectar(): PDO {
    try {
      $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->baseDatos", $this->usuario, $this->contrasena);
      $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $this->conexion;
    } catch (PDOException $e) {
      echo "Error al conectar a la base de datos: " . $e->getMessage();
      return null;
    }
  }

  public function desconectar() {
    $this->conexion = null;
  }
}
