<?php

namespace Raiz\Models;

use Raiz\Auxi\Serializador;
use Error;

abstract class ModelBase implements Serializador

{   
    const ACTIVO = 1;
    const INACTIVO = 0;
    const PRESTADO = 2;
    private $estado;
    private $id;

    public function setId($id): mixed
    {
         if ($id === null) :
            return 0;
        else :
            return intVal($id);
        endif; 
    }

    public function setEstado($nuevoEstado)
    {
        switch ($nuevoEstado) {
            case $nuevoEstado === static::ACTIVO:
                $this->estado = static::ACTIVO;
                break;
            case $nuevoEstado === static::INACTIVO:
                $this->estado = static::INACTIVO;
                break;
            case $nuevoEstado === static::PRESTADO:
                $this->estado = static::PRESTADO;
        }
    }

    public function __construct( $id, $estado = self::ACTIVO)
    {
        $this->estado=$estado;
        $this->id=$this->setId($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEstado(){
        return $this->estado;
    }

    /** @return mixed[] */
    public function serializar(): array
    {
        throw new Error('Serialización no implementada.');
    }

    public static function deserializar(array $datos): Self
    {
        throw new Error('Deserialización no implementada.');
    }
}
