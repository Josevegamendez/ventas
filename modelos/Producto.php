<?php

namespace modelo;

class Producto
{
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $impuestos;
    private $unidades;

    public function __construct($id, $nombre, $descripcion, $precio, $impuestos, $unidades)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->impuestos = $impuestos;
        $this->unidades = $unidades;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getImpuestos()
    {
        return $this->impuestos;
    }

    public function getUnidades()
    {
        return $this->unidades;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function setImpuestos($impuestos)
    {
        $this->impuestos = $impuestos;
    }

    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }
}
