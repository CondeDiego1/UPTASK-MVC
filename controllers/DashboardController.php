<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Proyecto;

class DashboardController {
    //Muestra la primera vista al iniciar session
    
    public static function index (Router $router) {
        isSession();
        isAuth();

        $proyectos = Proyecto::belongsTo('propietario', $_SESSION['codigousuario']);

        $router->view('dashboard/index',[
            'titulo' => 'Tus Proyectos',
            'proyectos' => $proyectos
        ]);
    }

    public static function Participante (Router $router) {
        isSession();
        isAuth();

        // substr_count($grupo,$_SESSION['codigousuario']);
        $proyectos = Proyecto::Participante('grupo', $_SESSION['codigousuario']);

        $router->view('dashboard/participante',[
            'titulo' => 'Proyectos en los que participas',
            'proyectos' => $proyectos
        ]);
    }

    public static function crearProyectos (Router $router){
        isSession();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $proyecto = new Proyecto($_POST);
            
            //Validación
            $alertas = $proyecto->validarNombreproyecto();
            if(empty($alertas)){
                /** Configuraciones para guardar el proyecto*/
                $proyecto->url = md5(uniqid());//Generar una URL única
                $proyecto->propietario = $_SESSION['codigousuario'];//Almacenar el creador del proyecto

                //Guardar proyecto
                if($proyecto->crear()){
                    header('Location: /proyecto?id=' . $proyecto->url);
                }
            }
        }

        $alertas = Proyecto::getAlertas();
        $router->view('dashboard/crear-proyecto',[
            'titulo' => 'Crear Proyectos',
            'alertas' => $alertas
        ]);
    }

    public static function Guardar (){
        $proyecto = new Proyecto($_POST); //Revise los datos que se envian por Fetch API
        $proyecto->url = md5(uniqid());//Generar una URL única   
        
        $respuesta = $proyecto->crear();//Guardar proyecto
        if($respuesta){
            /**
             * Si la respuesta es true o se guarda correctamente el registro se crea un objeto con esa 
             * respuesta más la url para direccionar desde JS
             */
            $args = [
                'respuesta' => $respuesta,
                'url' => $proyecto->url
            ];
            echo json_encode($args);
        }
    }

    public static function Proyecto (Router $router){
        isSession();
        isAuth();

        $alertas = [];
        $token = Sanitizar($_GET['id']);
        if(!$token) header('Location: /dashboard');

        //Revisar que la persona que visita el proyecto, es quien lo creo 
        $proyecto = Proyecto::where('url',$token);
        $grupo = explode(",", $proyecto->grupo);
        if($proyecto->propietario === $_SESSION['codigousuario'] || in_array($_SESSION['codigousuario'],$grupo)){

        } else {
            header('Location: /dashboard');
        }
        
        $router->view('dashboard/proyecto',[
            'titulo' => $proyecto->nombreproyecto,
            'alertas' => $alertas,
            'proyecto' => $proyecto
        ]);
    }

    public static function Perfil (Router $router){
        isSession(); 
        isAuth();
        $alertas = [];
        $usuario = Usuario::Find('codigousuario', $_SESSION['codigousuario']); //Consulta el usuario para mostrar los datos
        $_SESSION['avatar'] = $usuario->fotoperfil; //Para mantener actualizado el avatar al actualizar

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPerfil();

            if(empty($alertas)){
                //Se puede agregar la funcionalidad de cambiar email usando where y alertas, etc. video 670
                $usuarioanterior = Usuario::Find('codigousuario', $_SESSION['codigousuario']); 

                if($_POST['password'] !== ""){

                    $alertas = $usuario->nuevo_password();
                    if(!empty($alertas)){
                        return;
                    }

                    if (password_verify($_POST['password'], $usuarioanterior->password)) {
                        $resultado = $usuario->editarusuario($_SESSION['codigousuario'], $usuario->nombre, $usuario->fotoperfil, $usuario->password2);
                        
                        if($resultado){
                            $_SESSION['avatar'] = $usuario->fotoperfil;
                            $_SESSION['nombre'] = $usuario->nombre;
                            $script = true;
                        } else {
                            $script = false;
                        }

                    } else {
                        Usuario::setAlerta('error','La contraseña actual no coincide.');
                    }

                } else {
                    $resultado = $usuario->editarusuario($_SESSION['codigousuario'], $usuario->nombre, $usuario->fotoperfil, $usuario->password2);
                    if($resultado){
                        $_SESSION['avatar'] = $usuario->fotoperfil;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $script = true;
                    } else {
                        $script = false;
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();

        if(isset($script) && $script == true || isset($script) && $script == false){
            $router->view('dashboard/perfil',[
                'titulo' => 'Perfil',
                'alertas' => $alertas,
                'usuario' => $usuario,
                'script' => $script,
            ]);
        } else {
            $router->view('dashboard/perfil',[
                'titulo' => 'Perfil',
                'alertas' => $alertas,
                'usuario' => $usuario
            ]);
        }
        
    }

    public static function Añadir () {
        //$usuario = new Usuario($_POST); //Revise los datos que se envian por Fetch API
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);

            //Valida que exista el usuario
            $resultado = Usuario::ConsultaParametro('email', $_POST['emailnuevo']);

            //Obtenemos el código de proyecto
            $proyecto = Proyecto::ConsultaParametro('url', $_POST['url']);

            //Almacena los intregantes el la variable
            $grupo = $proyecto->grupo;

            //Validar que el usuario no sea participante
            if(substr_count($grupo,$resultado->codigousuario) > 0){
                echo json_encode($args = ['existe' => true]);
                return;
            }

            //Validar que el usuario no sea el propietario
            if($proyecto->propietario === $_SESSION['codigousuario']){
                echo json_encode($args = ['propietario' => true]);
                return;
            }

            if($resultado) {
                $respuesta = $usuario->Incluir($proyecto->codigoproyecto, $resultado->codigousuario, $grupo);
                echo json_encode($respuesta);
            }
        }
    }
}