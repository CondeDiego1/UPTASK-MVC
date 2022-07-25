<?php

namespace Model;

use Model\ActiveRecord;

class Usuario extends ActiveRecord {
    protected static $columnasDB = ['codigousuario','nombre','email','password','confirmado','token','fotoperfil'];
    protected static $tabla = 'usuarios';
    protected static $columna = 'codigousuario';
    public $codigousuario;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $confirmado;
    public $token;
    public $fotoperfil;

    function __construct(array $args = []){
        $this->codigousuario = $args['codigousuario'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->fotoperfil = $args['fotoperfil'] ?? '';
    }

    // Valida que los datos que se ingresan al input esten correctos y/o llenos
    public function validarlogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'EmaiL no valido';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    // Validamos que el usuario no existe para crearlo
    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "'";
        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            //Si la consulta realizada obtiene algún resultado se guarda el error en memoria para mostrarlo más adelante
            self::$alertas['error'][] = 'El usuario ya se encuentra registrado';
        }

        return $resultado;
    }

    /**
     * Valida los campos o inputs que digilencia el usuario al momento de creación al crear,
     * la función se dispara en el momento que le dan al input boton crear
     */
    public function nuevousuario () {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatorio';
        }

        if(strlen($this->password < 8)) {
            self::$alertas['error'][] = 'La contraseña debe contener mínimo 8 carácteres';
        }

        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    // Hashea la contraseña para que el dato almacenado este seguro 
    public function Hash_Password(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Crea los token para las diferentes gestiones como actualizar, recuperar
    public function Crear_Token(){
        $this->token = md5(uniqid());
    }

    // Valida que el email sea correcto
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'EmaiL no valido';
        }

        return self::$alertas;
    }

    // Metodo que crea el usuario
    public function Insertar(){
        $atributos = $this->sanitizarAtributos();
        $query = "INSERT INTO usuarios (" . join(',', array_keys($atributos)) . ")" . " VALUES ('" . join("','", array_values($atributos)) . "')";
        $resultado = $this->crear($query);
        return $resultado;
    }

    // Valida que las contraseñas sean correctas
    public function validarpassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatorio';
        }

        if(strlen($this->password < 8)) {
            self::$alertas['error'][] = 'La contraseña debe contener mínimo 8 carácteres';
        }

        return self::$alertas;
    }

    // Verificamos que el usuario este confirmado
    public function ComprobarPassword_Verificado($password){
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Contraseña incorrecto o tu cuenta no ha sido confirmada.';
            return false;
        } else {
            return true;
        }
    }

    /**
     * Esta función se ejecuta al momento de realizar la actualización de usuario, si va a cambiar el nombre 
     * el campo no debe estar vacío
     */
    public function validarPerfil () {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        //Este es opcional, no se está usando, ya que el email no permito cambiarlo (Se puede cambiar esa limitación)
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
    }

    /**
     * Actualiza la información del usuario, hay dos variantes la primera que solo actualice el nombre y foto de perfil, la otra incluye la contraseña
     */
    public function editarusuario($usuario, $nombre, $perfil, $contraseña){
        if($contraseña == ""){
            $query = "UPDATE usuarios SET nombre = '" . $nombre . "', fotoperfil = '" . $perfil . "' WHERE codigousuario = '" . $usuario . "'";
        } else {
            $contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
            $query = "UPDATE usuarios SET nombre = '" . $nombre . "', fotoperfil = '" . $perfil . "', password = '" . $contraseña . "' WHERE codigousuario = '" . $usuario . "'";
        }

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function nuevo_password () {
        if(!$this->password2) {
            self::$alertas['error'][] = 'La nueva contraseña no puede estar vacía.';
        }

        if(strlen($this->password2 < 8)) {
            self::$alertas['error'][] = 'La contraseña debe contener mínimo 8 carácteres';
        }

        return self::$alertas;
    }

    public function Incluir ($proyecto, $usuario, $grupo) {
        if($grupo == 0) {
            $stringgrupo = $usuario; //Se agrega directamente si está vacio
            // $arraygrupo = explode(",", $grupo);//Convierto el string en array
            // $stringgrupo = implode(",", $arraygrupo);//Convierto el array en string
        } else {
            $arraygrupo = explode(",", $grupo);//Convierto el string en array
            array_push($arraygrupo, $usuario);//Agrego el usuario al final del array
            $stringgrupo = implode(",", $arraygrupo);//Convierto el array en string
        }

        $query = "UPDATE proyectos SET grupo = '" . $stringgrupo . "' WHERE codigoproyecto = '" . $proyecto . "'";
        $resultado = $this->ActualizarTabla($query);
        return $resultado;
    }

    public function Excluir ($grupo, $proyecto) {
        $query = "UPDATE proyectos SET grupo = '" . $grupo . "' WHERE codigoproyecto = '" . $proyecto . "'";
        $resultado = $this->ActualizarTabla($query);
        return $resultado;
    }

    public function listaParticipantes ($grupo) {
        $stringgrupo = implode(",", $grupo);//Convierto el array en string
        $query = "SELECT codigousuario, nombre, email FROM usuarios WHERE codigousuario in($stringgrupo)";

        $resultado = $this->SQL2($query);
        return $resultado;
    }
}