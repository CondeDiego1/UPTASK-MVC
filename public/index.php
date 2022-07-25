<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\TareaController;
use Controllers\DashboardController;

$router = new Router();

//---------------------------------- Login ----------------------------------
$router->get('/',[LoginController::class, 'login']);
$router->post('/',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);

//---------------------------------- Crear cuenta ----------------------------------
$router->get('/crear_cuenta',[LoginController::class, 'crear_cuenta']);
$router->post('/crear_cuenta',[LoginController::class, 'crear_cuenta']);

//---------------------------------- Recuperar password ----------------------------------
$router->get('/recuperar_password',[LoginController::class, 'recuperar_password']);
$router->post('/recuperar_password',[LoginController::class, 'recuperar_password']);

//---------------------------------- Crear nueva password ----------------------------------
$router->get('/crear_password',[LoginController::class, 'crear_password']);
$router->post('/crear_password',[LoginController::class, 'crear_password']);

//---------------------------------- Confirmar cuenta ----------------------------------
$router->get('/mensaje_confirmacion_cuenta',[LoginController::class, 'mensaje_confirmacion_cuenta']);
$router->get('/confirmar_cuenta',[LoginController::class, 'confirmar_cuenta']);

//---------------------------------- Dashboard ----------------------------------
$router->get('/dashboard',[DashboardController::class, 'index']);
$router->get('/crear_proyectos',[DashboardController::class, 'crearProyectos']);
$router->post('/crear_proyectos',[DashboardController::class, 'crearProyectos']);
$router->get('/perfil',[DashboardController::class, 'Perfil']);
$router->post('/perfil',[DashboardController::class, 'Perfil']);
$router->get('/proyecto', [DashboardController::class,'Proyecto']);
$router->get('/participante', [DashboardController::class,'Participante']);
$router->post('/crear_proyectos/popup', [DashboardController::class,'Guardar']);
$router->post('/incluir', [DashboardController::class,'Añadir']);
$router->post('/participantes', [DashboardController::class,'Participantes']);
$router->post('/eliminar/participante', [DashboardController::class,'EliminarParticipante']);
$router->post('/api/proyecto/eliminar', [DashboardController::class,'EliminarProyecto']);

//Tareas
$router->get('/api/tareas', [TareaController::class,'index']);
$router->post('/api/tarea', [TareaController::class,'crear']);
$router->post('/api/tarea/actualizar', [TareaController::class,'actualizar']);
$router->post('/api/tarea/eliminar', [TareaController::class,'eliminar']);

//Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();