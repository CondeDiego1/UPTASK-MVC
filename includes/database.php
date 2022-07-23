<?php

declare(strict_types=1);
function conexionBD()
{
    $db = new mysqli('localhost', 'root', '', 'uptask');
    //$db = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_DATABASE']);
    $db->set_charset('utf8');

    if (!$db) {
        echo ('Ocurrió un fallo inesperado en la conexión');
        exit;
    }

    return $db;
}

