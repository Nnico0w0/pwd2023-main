<?php

namespace Raiz\Models;
use DateTime;

class Prestamo extends ModelBase
{
    private int $id;
    private Socio $socio;
    private Libro $libro;
    private $fecha_desde; 
    private $fecha_hasta;
    private ?string $fecha_dev = null;
//!agregar self::ACTIVO y los demas en los metodos al igual que el atributo.
    public function __construct(int $id, Socio $socio, Libro $libro, string $fecha_desde, string $fecha_hasta, $fecha_dev)
    {
        parent::__construct($id);
        $this->socio = $socio;
        $this->libro = $libro;
        $this->fecha_desde = date_create($fecha_desde);
        $this->fecha_hasta = date_create($fecha_hasta);
        $this->fecha_dev = $fecha_dev;
    }

    // Métodos getter

    public function getSocio(): Socio
    {
        return $this->socio;
    }

    public function getLibro(): Libro
    {
        return $this->libro;
    }

    public function getFechaDesde(): string
    {
        return $this->fecha_desde;
    }

    public function getFechaHasta(): string
    {
        return $this->fecha_hasta;
    }

    public function getFechaDev(): ?string
    {
        return $this->fecha_dev;
    }

    // Métodos setter
    public function setSocio(Socio $socio)
    {
        $this->socio = $socio;
    }

    public function setLibro(Libro $libro)
    {
        $this->libro = $libro;
    }

    public function setFechaDesde(string $fecha_desde)
    {
        $this->fecha_desde = $fecha_desde;
    }

    public function setFechaHasta(string $fecha_hasta)
    {
        $this->fecha_hasta = $fecha_hasta;
    }

    public function setFechaDev(?string $fecha_dev)
    {
        $this->fecha_dev = $fecha_dev;
    }

    public function serializar(): array
    {
        return [
            'id' => $this->getId(),
            'socio' => $this->socio->serializar(),
            'libro' => $this->libro->serializar(),
            'fecha_desde' => $this->getFechaDesde(),
            'fecha_hasta' => $this->getFechaHasta(),
            'fecha_dev' => $this->getFechaDev(),
        ];
    }

    static function deserializar(array $datos): ModelBase
    {
        return new Self(
            id: $datos['id'] === null ? 0 : $datos['id'],
            socio: $datos['socio'],
            libro: $datos['libro'],
            fecha_desde: $datos['fecha_desde'],
            fecha_hasta: $datos['fecha_hasta'],
            fecha_dev: $datos['fecha_dev']
        );
    }

    public function diasRetraso(): int {
        if ($this->fecha_dev === null) {
            return 0;
        }
        $fechaActual = date_create('now');
        $diasRetraso = date_diff($this->fecha_hasta,$fechaActual);
        $diasRetraso = $diasRetraso->days;
        if ($fechaActual < $this->fecha_hasta) {
            return 0;
        }else {
            return $diasRetraso;
        }
    }

    public function diasDeFalta(): int {
        if ($this->fecha_dev === null) {
            return 0; // El libro no ha sido devuelto, no hay falta
        }
        $fechaDevolucion = new DateTime($this->fecha_dev);
        $diferencia = $this->fecha_hasta->diff($fechaDevolucion);
        $diasFalta = $diferencia->days;

        if ($diasFalta > 0) {
            return $diasFalta; // Hay retraso en la devolución
        } else {
            return 0; // No hay retraso en la devolución
        }
    }
}
