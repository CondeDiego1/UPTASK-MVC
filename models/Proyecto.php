<?php

namespace Model;

use Model\ActiveRecord;

class Proyecto extends ActiveRecord {
    protected static $columnasDB = ['codigoproyecto','nombreproyecto','url','propietario','grupo'];
    protected static $tabla = 'proyectos';
    protected static $columna = 'codigoproyecto';
    // public $codigoproyecto;
    // public $nombreproyecto;
    // public $url;
    // public $propietario;
    // public $grupo;

    function __construct(array $args = []){
        $this->codigoproyecto = $args['codigoproyecto'] ?? NULL;
        $this->nombreproyecto = $args['nombreproyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietario = $args['propietario'] ?? '';
        $this->grupo = $args['grupo'] ?? 0;
    }

    function validarNombreproyecto (){
        if(!$this->nombreproyecto){
            self::$alertas['error'][] = 'El nombre del proyecto es obligatorio';
        }

        if(strlen($this->nombreproyecto) < 5){
            self::$alertas['error'][] = 'El nombre del proyecto es muy corto';
        }

        return self::$alertas;
    }
}

