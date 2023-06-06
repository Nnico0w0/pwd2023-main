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


  public function serializar(): array
  {
    return [
      'id' =>$this->getId(),
      'nombre' => $this->getNombre(),
      'activo' => $this->getActivo(),
    ];
  }

  public function deserializar(array $datos): ModelBase
  {
    return new self(
      id: $datos['id'] === null ? 0 : $datos['id'],
      nombre: $datos['nombre'],
      activo: $datos['activo'],
    );
  }
}
