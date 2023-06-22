<?php

namespace Raiz\Models;

class Editorial extends ModelBase
{
    private int $id;
    private string $nombre;


    public function __construct(int $id, string $nombre, int $estado = self::ACTIVO)
    {
        parent::__construct($id, $estado);
        $this->nombre = $nombre;
    }

    // Métodos getter
    public function getNombre(): string
    {
        return $this->nombre;
    }


    // Métodos setter
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }


  public function serializar(): array
  {
    return [
      'id' =>$this->getId(),
      'nombre' => $this->getNombre(),
      'estado' => $this->getEstado()
    ];
  }

  public static function deserializar(array $datos): ModelBase
  {
    return new self(
      id: $datos['id'] === null ? 0 : $datos['id'],
      nombre: $datos['nombre'],
      estado: $datos['estado'],
    );
  }
}
