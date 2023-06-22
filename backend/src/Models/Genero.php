<?php

namespace Raiz\Models;

class Genero extends ModelBase
{
    private int $id;
    private string $descripcion;

    public function __construct(int $id, string $descripcion, int $estado = self::ACTIVO)
    {
        parent::__construct($id, $estado);
        $this->descripcion = $descripcion;
    }

    // Métodos getter
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    // Métodos setter
    public function setDescripcion(string $descripcion)
    {
        $this->descripcion = $descripcion;
    }


  public function serializar(): array
  {
    return [
      'id' =>$this->getId(),
      'descripcion' => $this->getDescripcion(),
      'estado' => $this->getEstado()
    ];
  }

  public static function deserializar(array $datos): ModelBase
  {
    return new self(
      id: $datos['id'] === null ? 0 : $datos['id'],
      descripcion: $datos['descripcion'],
      estado: $datos['estado'],
    );
  }
}
