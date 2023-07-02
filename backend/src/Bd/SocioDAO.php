<?php

namespace Raiz\Bd;

use Raiz\Auxi\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Socio;


class SocioDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM socios';
        $listaSocios = ConectarBD::leer(sql: $sql);
        $socios = [];
        foreach ($listaSocios as $socio) {
            $socios[] = Socio::deserializar($socio);
        }
        return $socios;
    }
    public static function encontrarUno(string $id): ?Socio
    {
        $sql = 'SELECT * FROM socios WHERE id =:id;';
        $socio = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($socio) === 0) {
           return null;
        } else {
            $socio = Socio::deserializar($socio[0]);
            return $socio;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO socios ( nombre_apellido, fecha_alta, telefono, direccion, estado) VALUES ( :nombre_apellido, :fecha_alta, :telefono, :direccion, :estado)';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':nombre_apellido' => $params['nombre_apellido'],
                ':fecha_alta' => $params['fecha_alta'],
                ':telefono' => $params['telefono'],
                ':direccion' => $params['direccion'],
                ':estado' => $params['estado'],
                
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE socios 
        SET nombre_apellido =:nombre_apellido ,
        SET fecha_alta = :fecha_alta ,
        SET telefono = :telefono ,
        SET direccion = :direccion ,
        SET estado = :estado
        WHERE id=:id';

        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre_apellido' => $params['nombre_apellido'],
                ':fecha_alta' => $params['fecha_alta'],
                ':telefono' => $params['telefono'],
                ':direccion' => $params['direccion'],
                ':estado' => $params['estado']
            ]
        );
    }

    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM socios WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
}
