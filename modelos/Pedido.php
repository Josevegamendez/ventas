<?php

namespace modelo;

class Pedido
{
    private $id;
    private $fechaPedido;
    private $direccion;
    private $codigoPostal;
    private $estado;

    public function __construct($id, $fechaPedido, $direccion, $codigoPostal, $estado)
    {
        $this->id = $id;
        $this->fechaPedido = $fechaPedido;
        $this->direccion = $direccion;
        $this->codigoPostal = $codigoPostal;
        $this->estado = $estado;

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFechaPedido()
    {
        return $this->fechaPedido;
    }

    public function setFechaPedido($fechaPedido)
    {
        $this->fechaPedido = $fechaPedido;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

   
}
