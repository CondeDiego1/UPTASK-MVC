<?php

namespace Controllers;

use MVC\Router;
use Model\Email;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){
        $usuario = new Usuario;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarlogin();
            if(empty($alertas)){
                $usuario = Usuario::ConsultaParametro("email", $usuario->email);
                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error','El usuario no existe o no está confirmado');
                } else {
                    if (password_verify($_POST['password'], $usuario->password)){
                        session_start();
                        $_SESSION['codigousuario'] = $usuario->codigousuario;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['avatar'] = $usuario->fotoperfil;
                        $_SESSION['login'] = true;
                        $_SESSION["timeout"] = time();
                        header('Location: /dashboard');
                    } else {
                        Usuario::setAlerta('error','El email y/o la contraseña no coincide');
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();

        $router->view('auth/login',[
            'titulo' => 'Inicia Sesión',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    /* Cierra la session que se encuentra activa y redirreciona a login */
    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    /* Crea la cuenta de los usuarios */
    public static function crear_cuenta(Router $router){
        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST); // Sincroniza los datos que llegan por POST con las variables de la clase
            $alertas = $usuario->nuevousuario(); // Verifica que el usuario no exista

            if(empty($alertas)) {
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    unset($usuario->password2); //Eliminar del objeto que se va a almacenar en la BD
                    $usuario->Hash_Password(); //Hashear password
                    $usuario->Crear_Token(); //Crea el token para verificar
                    
                    if($usuario->Insertar()){
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token); //Enviar email
                        $resultado = $email->Enviar_Confirmacion();
                        if($resultado){
                            header('Location: /mensaje_confirmacion_cuenta');
                        }
                    }
                }
            }
        }

        $router->view('auth/crear_cuenta',[
            'titulo' => 'Crea Tu Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function recuperar_password(Router $router){
        $alertas = [];
        $usuario = new Usuario;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail(); //Validamos que exista el correo

            if(empty($alertas)){
                $resultado = $usuario->ConsultaParametro('email', $usuario->email); 
                if($resultado && $resultado->confirmado === "1"){ //Validamos que la cuenta esté confirmada
                    $resultado->Crear_Token();
                    $resultado->Actualizar(); //Actualiza la contraseña
                    $email = new Email($resultado->email, $resultado->nombre, $resultado->token); //Instancia la clase para enviar email
                    $email->Enviar_Instrucciones();
                    Usuario::setAlerta('exito', 'Esta acción requiere una verificación de correo. Por favor revisa tu buzón de correo y sigue las instrucciones enviadas para reestablecer tu contraseña.'); 
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado.'); 
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->view('auth/recuperar_password',[
            'titulo' => 'Olvide Mi Contraseña',
            'alertas' => $alertas,
            'usuario' => $usuario,
        ]);
    }

    public static function crear_password(Router $router){
        $alertas = [];
        $error = false;
        $token = Sanitizar($_GET['token']);
        if(!$token) header('Location: /');
        $usuario = Usuario::ConsultaParametro('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $contraseña = new Usuario($_POST);
            $alertas = $usuario->validarpassword();
            if(empty($alertas)){
                $usuario->password = $contraseña->password;
                $usuario->Hash_Password();//Hashear password
                $usuario->token = null;
                if($usuario->Actualizar()){
                    Usuario::setAlerta('exito', 'Tu contraseña se reestablecio con éxito.');
                    $bandera = true;
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->view('auth/crear_password',[
            'titulo' => 'Crear Nueva Contraseña',
            'alertas' => $alertas,
            'error' => $error,
            'bandera' => $bandera
        ]);
    }

    public static function mensaje_confirmacion_cuenta(Router $router){
        $router->view('auth/mensaje_confirmacion',[
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar_cuenta(Router $router){
        $alertas = [];
        $token = Sanitizar($_GET['token']);
        if(!$token) header('Location: /');
        $usuario = Usuario::ConsultaParametro('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
        } else {
            unset($usuario->password2);//Eliminar del objeto 
            $usuario->confirmado = "1";
            $usuario->token = null;
            // Debuguear($usuario);
            if($usuario->Actualizar()){
                Usuario::setAlerta('exito', 'Tu cuenta se validó con éxito.');
            }
        }

        $alertas = Usuario::getAlertas();
        $router->view('auth/confirmar_cuenta',[
            'titulo' => 'Confirma Tu Cuenta',
            'alertas' => $alertas
        ]);
    }
}