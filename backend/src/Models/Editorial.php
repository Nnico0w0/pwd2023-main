<?php

namespace Raiz\Models;

class Editorial extends ModelBase
{
    private int $id;
    private string $nombre;
    private int $activo;


    public function __construct(int $id, string $nombre, int $activo)
    {
        parent::__construct($id);
        $this->nombre = $nombre;
        $this->activo = $activo;
    }

    // Métodos getter
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getActivo(): int
    {
        return $this->activo;
    }

    // Métodos setter
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function setActivo(int $activo)
    {
        $this->activo = $activo;
    }
}
