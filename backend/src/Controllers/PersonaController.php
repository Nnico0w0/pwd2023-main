<?php
namespace Raiz\Controllers;

use Raiz\Bd\PersonaDAO;
use Raiz\Models\Persona;

class PersonaController implements InterfaceController{
   
    //Clase que controla de acuerdo a lo que pida la vista: 
    // --- CRUD --- 
    //  Listar 
    //  encontrar uno
    //  crear
    //  actualizar
    //  borrar  

    public static function listar(): array
    {
        $personas = [];
        $listadoPersona = PersonaDAO::listar();
        foreach($listadoPersona as $persona){
            $personas[] = $persona->serializar();
        }
        return $personas;

        
    }
    
    public static function encontrarUno(string $dni): ?array
    {
        $persona = PersonaDAO::encontrarUno($dni);
        if($persona===null){
            return $persona;
        }else{
            return $persona->serializar();
        }
        
        
        
    }
    public static function crear(array $parametros): array
    {
        $persona = Persona::deserializar($parametros);
        PersonaDAO::crear($persona);
        return $persona->serializar();
    }

    public static function actualizar(array $parametros): array
    {
        $persona = Persona::deserializar($parametros);
        PersonaDAO::actualizar($persona);
        return $persona->serializar();
    }

    public static function borrar(string $id):void
    {
        PersonaDAO::borrar($id);
        
    }

}

