<?php
namespace Model;
class ActiveRecord {

    //------------------------------- ATRIBUTOS -------------------------------
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];
    protected static $alertas = [];// Alertas y Mensajes

    //------------------------------- FUNCIONES -------------------------------
    public static function setDB($database){//Conexión
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    public function Id(){
        if(static::$tabla == 'usuarios'){
            $id = $this->codigousuario;
        }// else if (static::$tabla == 'usuarios'){
        //     $id = $this->usuario;
        // } else if (static::$tabla == 'citas') {
        //     $id = $this->idCita;
        // }
        return $id;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'codigousuario' || $columna === 'codigoproyecto' || $columna === 'codigotarea') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    //Reescribre el args con el array del $_POST
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    public static function Listar() {
        $query = "SELECT * FROM " . static::$tabla;
        
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function Find($columna, $id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE " . $columna . " = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registro
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Busqueda Where con Columna 
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    //Busca todos los registros
    public static function belongsTo($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // SQL para Consultas Avanzadas.
    public static function SQL($consulta) {
        $query = $consulta;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // crea un nuevo registro
    public function Crear_() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // Resultado de la consulta
        if (static::$tabla == 'tareas') {
            $celda = 'codigotarea';
        } 
        // else if (static::$tabla == 'citasservicios' || static::$tabla == 'servicios'){
        //     $celda = 'id';
        // }
        // return json_encode(['query' => $query]); //Ver la respuesta Fecth que estamos ejecutando
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           $celda => self::$db->insert_id
        ];
    }

    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        //Debuguear($query);
        // Resultado de la consulta
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function Actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $id = $this->Id();

        $query = "UPDATE ". static::$tabla ." SET " . join(', ',$valores) . " WHERE ". static::$columna . " = '" . self::$db->escape_string($id) . "'";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un registro - Toma el ID de Active Record
    public function eliminar_() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function Eliminar($query) {
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    public static function SQL2 ($query) {
        $resultado = self::$db->query($query);
        $array = [];
        
        while($registro = $resultado->fetch_assoc()) {
            $array[] = $registro;
        }

        return $array;
    }

    public static function ConsultaParametro(string $campo, $valor){
        $query = "SELECT * FROM " . static::$tabla. " WHERE $campo = '{$valor}'";
        $resultado = self::$db->query($query);

        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        } 

        $resultado->free();

        return array_shift($array);
        //array_shift elimina el primer elemento del array, se convierte en un tipo de objeto
    }

    public function ActualizarTabla ($query) {
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function Participante ($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} like '%${valor}%'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}