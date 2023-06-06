<?php

namespace Raiz\Bd;

use Raiz\Aux\Serializador;
use Raiz\Bd\InterfaceDAO;
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


    public static function borrar(string $id)
    {
    }
}