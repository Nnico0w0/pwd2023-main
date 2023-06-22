<?php

namespace Raiz\Bd;

use Raiz\Auxi\Serializador;
use Raiz\Models\Persona;

class PersonaDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM personas';
        $listaPersona = ConectarBD::leer(sql: $sql);
        $personas = [];
        foreach ($listaPersona as $persona) {
            $personas[] = Persona::deserializar($persona);
        }
        return $personas;
    }

    public static function encontrarUno(string $dni): ?Persona
    {
        $sql = 'SELECT * FROM personas WHERE dni =:dni;';
        $persona = ConectarBD::leer(sql: $sql, params: [':dni' => $dni]);
        if (count($persona) === 0) {
            return null;
        } else {
            $persona = Persona::deserializar($persona[0]);
            return $persona;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO personas (dni, nombre_apellido ) VALUES (:dni, :nombre_apellido)';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':dni' => $params['dni'],
                ':nombre_apellido' => $params['nombre_apellido']
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE personas SET nombre_apellido =:nombre_apellido WHERE dni=:dni';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':dni' => $params['dni'],
                ':nombre_apellido' => $params['nombre_apellido']
            ]
        );
    }
    public static function borrar(string $dni)
    {
    }
}
