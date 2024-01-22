<?php
// Habilitar CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require_once './core/authFuntions.php';
require_once './core/responseData.class.php';

$_auth = new auth;
$_response = new responseData;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el cuerpo de la solicitud como JSON
    $requestBody = file_get_contents('php://input');
    $requestData = json_decode($requestBody, true);
    $datosArray = $_auth->login($requestData);
    print_r(json_encode($datosArray));
} else {
    echo "metodo no permitido";
}


?>