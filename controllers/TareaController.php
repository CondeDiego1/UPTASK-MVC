<?php

namespace Controllers;

use Model\Tarea;
use Model\Proyecto;

class TareaController {
    public static function index () {
        isSession();
        isAuth();
        $url = $_GET['id'];
        if(!$url) header('Location: /dashboard');

        $proyecto = Proyecto::where('url', $url);
        //if($proyecto->propietario === $_SESSION['codigousuario'] || in_array($_SESSION['codigousuario'],$grupo)) header('Location: /404');
        $grupo = explode(",", $proyecto->grupo);
        if($proyecto->propietario === $_SESSION['codigousuario'] || in_array($_SESSION['codigousuario'], $grupo)){
            $participante = false;
        } else {
            header('Location: /404');
        }

        if($proyecto->propietario !== $_SESSION['codigousuario']){
            $participante = true;
        }

        $tareas = Tarea::belongsTo('proyecto', $proyecto->codigoproyecto);
        // Debuguear($tareas);
        echo json_encode(['tareas' => $tareas, 'participante' => $participante], JSON_PRETTY_PRINT);
        //echo json_encode(['tareas' => $tareas]);
    }

    public static function crear(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            isSession();
            isAuth();

            $proyecto = Proyecto::where('url', $_POST['proyecto']);
            if(!$proyecto || $proyecto->propietario !== $_SESSION['codigousuario']) {
                $respuesta = [
                    'icon' => 'error',
                    'tipo' => 'Error',
                    'mensaje' => 'No se pudo crear la tarea',
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyecto = $proyecto->codigoproyecto;
            $resultado = $tarea->Crear_();
            if($resultado['resultado']){
                $respuesta = [
                    'icon' => 'success',
                    'tipo' => 'Éxito',
                    'mensaje' => 'Tu tarea se creó correctamente',
                    'codigotarea' => $resultado['codigotarea'],
                    'proyecto' => $proyecto->propietario
                ];
                echo json_encode($respuesta);
            }
        }
    }

    public static function actualizar (){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            isSession();
            isAuth();
            $proyecto = Proyecto::where('url', $_POST['url']);

            if(!$proyecto || $proyecto->propietario !== $_SESSION['codigousuario']) {
                $respuesta = [
                    'icon' => 'error',
                    'tipo' => 'Error',
                    'mensaje' => 'No se pudo actualizar la tarea',
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $resultado = $tarea->actualizarTarea($tarea->codigotarea, $tarea->nombretarea, $tarea->estadotarea);
            //echo json_encode($resultado);
            // echo json_encode($resultado);
            // return;
            if($resultado){
                $respuesta = [
                    'icon' => 'success',
                    'tipo' => 'Éxito',
                    'mensaje' => 'Tu tarea se actualizó correctamente',
                    'codigotarea'=> $tarea->codigotarea
                ];
                echo json_encode($respuesta);
            }
        }
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            isSession();
            isAuth();
            $proyecto = Proyecto::where('url', $_POST['url']);

            if(!$proyecto || $proyecto->propietario !== $_SESSION['codigousuario']) {
                $respuesta = [
                    'icon' => 'error',
                    'tipo' => 'Error',
                    'mensaje' => 'No se pudo eliminar la tarea',
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $resultado = $tarea->eliminarTarea($tarea->codigotarea);
            echo json_encode($resultado);
        }
    }
}