<?php
// index.php

// Carga los controladores
require_once './controllers/Controlador1.php';
require_once './controllers/Controlador2.php';

// Función para manejar la solicitud según la URL
function enrutador($url) {
    switch ($url) {
        case 'controlador1':
            $controlador = new Controlador1();
            break;
        case 'controlador2':
            $controlador = new Controlador2();
            break;
        default:
            // Página no encontrada
            header("HTTP/1.0 404 Not Found");
            echo "Página no encontrada";
            exit;
    }

    // Llama al método para manejar la solicitud en el controlador
    $controlador->manejarSolicitud();
}

// Obtén la parte de la URL después del nombre del archivo (index.php)
$url = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';

// Enruta la solicitud
enrutador($url);
?>
