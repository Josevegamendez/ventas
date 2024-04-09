<?php

namespace modelo;

class Cliente
{
    private $id;
    private $nombre;
    private $identificacion;
    private $apellidos;
    private $telefono;
    private $correo;
    private array $pedidoDetalle = [];

    public function __construct($id, $nombre, $identificacion, $apellidos, $telefono, $correo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->identificacion = $identificacion;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->correo = $correo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getPedidoDetalle()
    {
        return $this->pedidoDetalle;
    }

    public function setPedidoDetalle($pedidoDetalle)
    {
        $this->pedidoDetalle = $pedidoDetalle;
    }
}
