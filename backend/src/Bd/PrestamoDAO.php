<?php

namespace Raiz\Bd;

use Raiz\Auxi\Serializador;
use Raiz\Bd\InterfaceDAO;
use Raiz\Models\Libro;
use Raiz\Models\Prestamo;


class PrestamoDAO implements InterfaceDAO
{

    public static function listar(): array
    {
        $sql = 'SELECT * FROM prestamos';
        $listaPrestamos = ConectarBD::leer(sql: $sql);
        $prestamos = [];
        foreach ($listaPrestamos as $prestamo) {
            $prestamos[] = Prestamo::deserializar($prestamo);
        }
        return $prestamos;
    }
    public static function encontrarUno(string $id): ?Prestamo
    {
        $sql = 'SELECT * FROM prestamos WHERE id =:id;';
        $prestamo = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($prestamo) === 0) {
            return null;
        } else {
            $prestamo = prestamo::deserializar($prestamo[0]);
            return $prestamo;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO prestamos
        (
            id,
            socio, 
            libro, 
            fecha_desde, 
            fecha_hasta, 
            fecha_dev
            ) 
        VALUES
        (
            :id,
            :socio,
            :libro,
            :fecha_desde,
            :fecha_hasta,
            :fecha_dev
            );';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':socio' => $params['socio']->getId(),
                ':libro' => $params['libro']->getId(),
                ':fecha_desde' => $params['fecha_desde'],
                ':fecha_hasta' => $params['fecha_hasta'],
                ':fecha_dev' => $params['fecha_dev']
            ]
        );
        $params['libro']::PRESTADO;
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE prestamos 
        SET socio =:socio,
        SET libro =:libro,
        SET fecha_desde =:fecha_desde,
        SET fecha_hasta =:fecha_hasta,
        SET fecha_dev =:fecha_dev,
        WHERE id=:id';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':socio' => $params['socio'],
                ':libro' => $params['libro'],
                ':fecha_desde' => $params['fecha_desde'],
                ':fecha_hasta' => $params['fecha_hasta'],
                ':fecha_dev' => $params['fecha_dev']
            ]
        );
    }

    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM prestamos WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }
    
    public static function libroDevuelto(string $idLibro){
        $objLibro = LibroDAO::encontrarUno($idLibro);
        return $objLibro->getEstado();
    }
    
    public static function diasRetraso($idObj): int
    {
        $obj = self::encontrarUno($idObj);
        if ($obj->getFechaDev() === null) {
            return 0;
        }
        $fechaActual = date_create('now');
        $diasRetraso = date_diff(date_create($obj->getFechaHasta()), $fechaActual);
            return $diasRetraso->days;
    }
}
