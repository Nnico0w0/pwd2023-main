<?php

namespace Raiz\Models;

class Categoria extends ModelBase
{
    private int $id;
    private string $descripcion;
    private int $activo;


    public function __construct(int $id, string $descripcion, int $activo)
    {
        parent::__construct($id);
        $this->descripcion = $descripcion;
        $this->activo = $activo;
    }

    // Métodos getter
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getActivo(): int
    {
        return $this->activo;
    }

    // Métodos setter
    public function setDescripcion(string $descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setActivo(int $activo)
    {
        $this->activo = $activo;
    }
}
