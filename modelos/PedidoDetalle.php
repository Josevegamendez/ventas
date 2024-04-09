<?php

namespace modelo;

class PedidoDetalle
{

    private $id;
    private $clienteId;
    private $productoId;
    private $pedidoId;
    private $cantidad;
    private $nota;
  

    public function __construct($id, $clienteId, $productoId, $pedidoId, $cantidad, $nota)
    {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->productoId = $productoId;
        $this->pedidoId = $pedidoId;
        $this->cantidad = $cantidad;
        $this->nota = $nota;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getClienteId()
    {
        return $this->clienteId;
    }

    public function setClienteId($clienteId)
    {
        $this->clienteId = $clienteId;
    }

    public function getProductoId()
    {
        return $this->productoId;
    }

    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
    }

    public function getPedidoId()
    {
        return $this->pedidoId;
    }

    public function setPedidoId($pedidoId)
    {
        $this->pedidoId = $pedidoId;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }
}
