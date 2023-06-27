<?php
namespace Raiz\Auxi;
Class Utileria {

    public static function PasarAJson(String $AJson):Array{
     
        return Json_Decode($AJson, true);

    }
}