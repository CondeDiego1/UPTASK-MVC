<?php 
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);//Llama la dependencia de Dotenv
$dotenv->safeLoad();//Valida que si el archivo no existe no genere error
require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
$db = conexionBD();
use Model\ActiveRecord;
ActiveRecord::setDB($db);