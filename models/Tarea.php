<?php

namespace Model;

use Model\ActiveRecord;

class Tarea extends ActiveRecord{
    protected static $columnasDB = ['codigotarea','nombretarea','estadotarea','proyecto'];
    protected static $tabla = 'tareas';
    protected static $columna = 'codigotarea';

    function __construct(array $args = []) {
        $this->codigotarea = $args['codigotarea'] ?? NULL;
        $this->nombretarea = $args['nombretarea'] ?? '';
        $this->estadotarea = $args['estadotarea'] ?? 0;
        $this->proyecto = $args['proyecto'] ?? '';
    }

    public function actualizarTarea($id, $nombre, $estado){
        $query = "UPDATE tareas SET estadotarea = '" . $estado . "', nombretarea = '" . $nombre . "' WHERE codigotarea = '" . $id . "'";
        $resultado = $this->ActualizarTabla($query);

        return $resultado;
    }

    public function eliminarTarea($id){
        $query = "DELETE FROM tareas WHERE codigotarea = '" . $id . "' LIMIT 1";
        $resultado = $this->Eliminar($query);

        return $resultado;
    }
}