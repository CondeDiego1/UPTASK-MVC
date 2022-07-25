<?php

function Debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function Sanitizar(string $html) : string {
    $sanitizar = htmlspecialchars($html, ENT_QUOTES);
    return $sanitizar;
}
// Función que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function CerrarSesion(){
    session_start(); 
    $_SESSION = []; 
    header('Location: /login');
}

function isSession(){
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
}