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
    
  public function serializar(): array
  {
    return [
      'id' =>$this->getId(),
      'nombre_apellido' => $this->getNombreApellido(),
      'activo' => $this->getActivo(),
    ];
  }

  public function deserializar(array $datos): ModelBase
  {
    return new self(
      id: $datos['id'] === null ? 0 : $datos['id'],
      nombre_apellido: $datos['nombre_apellido'],
      activo: $datos['activo'],
    );
  }
}
