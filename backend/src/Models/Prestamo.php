<?php

namespace Raiz\Models;
use DateTime;

class Prestamo extends ModelBase
{
    private int $id;
    private Socio $socio;
    private Libro $libro;
    private $fecha_desde; //!me dio error al tenerlos como string y definirlos como date en el constructor
    private $fecha_hasta;
    private ?string $fecha_dev = null;

    public function __construct(int $id, Socio $socio, Libro $libro, string $fecha_desde, string $fecha_hasta)
    {
        parent::__construct($id);
        $this->socio = $socio;
        $this->libro = $libro;
        $this->fecha_desde = date_create($fecha_desde);
        $this->fecha_hasta = date_create($fecha_hasta);
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
