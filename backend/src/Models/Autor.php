<?php

namespace Raiz\Models;

class Autor extends ModelBase
{
    private int $id;
    private string $nombre_apellido;
    private int $activo;


    public function __construct(int $id, string $nombre_apellido, int $activo)
    {
        parent::__construct($id);
        $this->nombre_apellido = $nombre_apellido;
        $this->activo = $activo;
    }

    // Métodos getter
    public function getNombreApellido(): string
    {
        return $this->nombre_apellido;
    }

    public function getActivo(): int
    {
        return $this->activo;
    }

    // Métodos setter
    public function setNombreApellido(string $nombre_apellido)
    {
        $this->nombre_apellido = $nombre_apellido;
    }

    public function setActivo(int $activo)
    {
        $this->activo = $activo;
    }
}