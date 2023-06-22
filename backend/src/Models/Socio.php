<?php

declare(strict_types=1);

namespace Raiz\Models;

class Socio extends ModelBase
{
  private string $nombre_apellido;
  private string $fecha_alta;
  private int $telefono;
  private string $direccion;

  public function __construct(
    int $id, 
    string $nombre_apellido, 
    string $fecha_alta, 
    int $estado = self::ACTIVO, 
    int $telefono,
    string $direccion)
  {
    parent::__construct($id, $estado);
    $this->nombre_apellido = $nombre_apellido;
    $this->fecha_alta = $fecha_alta;
    $this->telefono = $telefono;
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

  public function getTelefono(): int
  {
    return $this->telefono;
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

  public function setTelefono(int $telefono)
  {
    $this->telefono = $telefono;
  }

  public function setDireccion(string $direccion)
  {
    $this->direccion = $direccion;
  }

  public function serializar(): array
  {
    return [
      'id' =>$this->getId(),
      'nombre_apellido' => $this->getNombreApellido(),
      'fecha_alta' => $this->getFechaAlta(),
      'estado' => $this->getEstado(),
      'telefono' => $this->getTelefono(),
      'direccion' => $this->getDireccion()
    ];
  }

  public static function deserializar(array $datos): ModelBase
  {
    return new self(
      id: $datos['id'] === null ? 0 : $datos['id'],
      nombre_apellido: $datos['nombre_apellido'],
      fecha_alta: $datos['fecha_alta'],
      estado: $datos['estado'],
      telefono: $datos['telefono'],
      direccion: $datos['direccion']
    );
  }


}