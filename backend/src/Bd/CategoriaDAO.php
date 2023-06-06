<?php
namespace Raiz\Bd;

use Raiz\Models\Categoria;

class CategoriaDAO implements InterfaceDAO{

public static function listar(): array
{
$sql = 'SELECT * FROM categoria';
$listaCategoria = ConectarBD::leer(sql: $sql);
$categorias = [];
foreach ($listaCategoria as $categoria) {
    $categorias[] = Categoria::deserializar($categoria);
}
return $categorias;
}
public static function encontrarUno(string $id): ?Categoria
{
$sql = 'SELECT * FROM categoria WHERE id =:id;';
$categoria = ConectarBD::leer(sql: $sql, params: [':id' => $id]);
if (count($categoria) === 0) {
   return null;
} else {
    $categoria = Categoria::deserializar($categoria[0]);
    return $categoria;
}
}

public static function crear(Serializador $instancia): void
{
$params = $instancia->serializar();
$sql = 'INSERT INTO categoria (id, descripcion, activo) VALUES (:id, :descripcion, :activo)';
ConectarBD::escribir(
    sql: $sql,
    params: [
        ':id' => $params['id'],
        ':descripcion' => $params['descripcion'],
        ':activo' => $params['activo']
    ]
);
}

public static function actualizar(Serializador $instancia): void
{
$params = $instancia->serializar();
$sql = 'UPDATE categoria SET descripcion =:descripcion WHERE id=:id';
ConectarBD::escribir(
    sql: $sql,
    params: [
        ':id' => $params['id'],
        ':descripcion' => $params['descripcion'],
    ]
);
}
public static function borrar(string $id)
{
}

}