<?php

namespace Raiz\Models;
use Raiz\Models\ModelBase;

class Autor extends ModelBase
{
    private int $id;
    private string $nombre_apellido;


    public function __construct(int $id, string $nombre_apellido, int $estado = self::ACTIVO)
    {
        parent::__construct($id, $estado);
        $this->nombre_apellido = $nombre_apellido;
    }

    // Métodos getter
    public function getNombreApellido(): string
    {
        return $this->nombre_apellido;
    }

    // Métodos setter
    public function setNombreApellido(string $nombre_apellido)
    {
        $this->nombre_apellido = $nombre_apellido;
    }

  public function serializar(): array
  {
    return [
      'id' =>$this->getId(),
      'nombre_apellido' => $this->getNombreApellido(),
      'estado' => $this->getEstado()
    ];
  }

  public static function deserializar(array $datos): ModelBase
  {
    return new self(
      id: $datos['id'] === null ? 0 : $datos['id'],
      nombre_apellido: $datos['nombre_apellido'],
      estado: $datos['estado'],
    );
  }
}
