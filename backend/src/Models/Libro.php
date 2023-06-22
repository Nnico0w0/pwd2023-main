<?php

namespace Raiz\Models;

//use Error;

class Libro extends ModelBase
{

    private $titulo;
    /** @var Editorial */
    private $editorial;
    /** @var array Autor */
    private array $autor;
    /** @var Genero */
    private $genero;
    /** @var Categoria */
    private $categoria;
    private $cant_paginas;
    private $anio;

    public function __construct(
        $id,
        string $titulo,
        array $autorList,
        Editorial $editorial,
        int $cant_paginas,
        int $anio,
        Genero $genero,
        Categoria $categoria,
        int $estado = self::ACTIVO

    ) {
        parent::__construct($id, $estado);
        $this->titulo = $titulo;
        $this->editorial = $editorial;
        $this->autor = $autorList;
        $this->genero = $genero;
        $this->cant_paginas = $cant_paginas;
        $this->anio = $anio;
        $this->categoria = $categoria;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function getGenero(): Genero
    {
        return $this->genero;
    }
    public function getEditorial(): Editorial
    {
        return $this->editorial;
    }
    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }
    public function getCant_Pag(): int
    {
        return $this->cant_paginas;
    }
    public function getAnio_Pub(): int
    {
        return $this->titulo;
    }
    public function getAutores(): array
    {
        $listaAutores = [];
        foreach ($this->autor as $autor) {
            $listaAutores = $autor->serializar();
        }
        return $listaAutores;
    }

    //---- Setters ----//
    public function setTitulo(string $nuevoTitulo)
    {
        $this->titulo = $nuevoTitulo;
    }

    public function setAutor(array $nuevoAutorList)
    {
        foreach ($nuevoAutorList as $autor) {
            $this->autor[] = $autor;
        }
    }

    public function setCategoria(Categoria $nuevaCategoria)
    {
        $this->categoria = $nuevaCategoria;
    }

    public function setGenero(Categoria $nuevoGenero)
    {
        $this->genero = $nuevoGenero;
    }

    public function setEditorial(Editorial $nuevaEditorial)
    {
        $this->editorial = $nuevaEditorial;
    }

    public function setCantPaginas(int $nuevaCantidadPaginas)
    {
        $this->cant_paginas = $nuevaCantidadPaginas;
    }

    public function serializar(): array
    {
        return [
            'id' => $this->getId(),
            'titulo' => $this->getTitulo(),
            'autor' => $this->getAutores(),
            'editorial' => $this->editorial->serializar(),
            'cant_paginas' => $this->getCant_Pag(),
            'genero' => $this->genero->serializar(),
            'categoria' => $this->categoria->serializar(),
            'estado' => $this->getEstado(),
            'anio' => $this->getAnio_Pub()
        ];
    }

    static function deserializar(array $datos): ModelBase
    {
        return new Self(
            id: $datos['id'] === null ? 0 : $datos['id'],
            titulo: $datos['titulo'],
            autorList: $datos['autor'],
            editorial: $datos['editorial'],
            cant_paginas: $datos['cant_paginas'],
            anio: $datos['anio'],
            genero: $datos['genero'],
            categoria: $datos['categoria'],
            estado: $datos['estado']
        );
    }
}
