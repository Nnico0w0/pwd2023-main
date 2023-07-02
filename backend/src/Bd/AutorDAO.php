<?php

namespace Raiz\Bd;
use Raiz\Bd\InterfaceDao;
use Raiz\Models\Autor;
use Raiz\Auxi\Serializador;

class AutorDAO implements InterfaceDao{

        public static function listar(): array
    {
        $sql = 'SELECT * FROM autores';
        $listaAutor = ConectarBD::leer(sql: $sql);
        $autores = [];
        foreach ($listaAutor as $autor) {
            $autores[] = Autor::deserializar($autor);
        }
        return $autores;
    }
    public static function encontrarUno(string $id): ?Autor
    {
        $sql = 'SELECT * FROM autores WHERE id =:id;';
        $autor = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
        if (count($autor) === 0) {
           return null;
        } else {
            $autor = Autor::deserializar($autor[0]);
            return $autor;
        }
    }

    public static function crear(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'INSERT INTO autores (id, nombre_apellido, activo) VALUES (:id, :nombre_apellido, :activo)';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre_apellido' => $params['nombre_apellido'],
                ':activo' => Autor::ACTIVO
            ]
        );
    }

    public static function actualizar(Serializador $instancia): void
    {
        $params = $instancia->serializar();
        $sql = 'UPDATE autores SET nombre_apellido =:nombre_apellido WHERE id=:id';
        ConectarBD::escribir(
            sql: $sql,
            params: [
                ':id' => $params['id'],
                ':nombre_apellido' => $params['nombre_apellido'],
            ]
        );
    }
    public static function borrar(string $id)
    {
        $sql = 'DELETE FROM autores WHERE id=:id';
        ConectarBD::escribir(sql: $sql, params: [':id' => $id]);
    }

}