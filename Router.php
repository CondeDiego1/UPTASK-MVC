<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas() {
        session_start();
        //Cambio PATH_INFO por REQUEST_URI, por que el primero es de forma local
        //$currentUrl = $_SERVER['REQUEST_URI'] === ''? '/' : $_SERVER['REQUEST_URI']; //No funciona
        if (isset($_SERVER['PATH_INFO'])) {
            $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        } else {
            $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        }

        // $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        $rutas_protegidas = ['/crear_cuenta','/recuperar_password','/crear_password','/mensaje_confirmacion_cuenta','/confirmar_cuenta','/'];

        if(in_array($currentUrl, $rutas_protegidas) && isset($_SESSION['login'])){
            header('Location: /dashboard');
        }

        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            include __DIR__ . "/views/pagina/error.php";
        }
    }

    public function view($view, $datos = []) {
        //Leer las variables que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            /**
            * Doble signo de dolar significa: variable variable, básicamente nuestra 
            * variable sigue siendo la original, pero al asignarla a otra no la reescribe, 
            * mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
            */
            $$key = $value;
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}
