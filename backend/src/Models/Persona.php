<?php

declare(strict_types=1);

namespace Raiz\Models;

use Raiz\Models\ModelBase;

class Persona extends ModelBase
{
    private $nombre_apellido;
    private $dni;

    function __construct(string $nombre_apellido, int $dni)
    {
        $this->nombre_apellido = $nombre_apellido;
        $this->dni = $dni;
    }
    // Métodos getter
    public function getNombreApellido()
    {
        return $this->nombre_apellido;
    }

    public function getDni()
    {
        return $this->dni;
    }

    // Métodos setter
    public function setNombreApellido($nuevoNombre)
    {
        $this->nombre_apellido = $nuevoNombre;
    }


  public function serializar(): array
  {
    return [
      'dni' => $this->getDni(),
      'nombre_apellido' => $this->getNombreApellido()
    ];
  }

  public function deserializar(array $datos): ModelBase
  {
    return new self(
      dni: $datos['dni'],
      nombre_apellido: $datos['nombre_apellido'],
    );
  }
}
