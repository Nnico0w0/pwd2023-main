<?php

declare(strict_types=1);

namespace Raiz\Models;

class Socio extends ModelBase
{
  private int $id;
  private string $nombre_apellido;
  private string $fecha_alta;
  private int $activo;
  private string $direccion;


  public function __construct(int $id, string $nombre_apellido, string $fecha_alta, int $activo, string $direccion)
  {
    parent::__construct($id);
    $this->nombre_apellido = $nombre_apellido;
    $this->fecha_alta = $fecha_alta;
    $this->activo = $activo;
    $this->direccion = $direccion;
  }

  // Métodos getter
  public function getNombreApellido(): string
  {
    return $this->nombre_apellido;
  }

  public function getFechaAlta(): string
  {
    return $this->fecha_alta;
  }

  public function getActivo(): int
  {
    return $this->activo;
  }

  public function getDireccion(): string
  {
    return $this->direccion;
  }

  // Métodos setter
  public function setNombreApellido(string $nombre_apellido)
  {
    $this->nombre_apellido = $nombre_apellido;
  }

  public function setFechaAlta(string $fecha_alta)
  {
    $this->fecha_alta = $fecha_alta;
  }

  public function setActivo(int $activo)
  {
    $this->activo = $activo;
  }

  public function setDireccion(string $direccion)
  {
    $this->direccion = $direccion;
  }
}