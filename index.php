<?php
require_once "core/ConexionDB.php";
require_once "core/responseData.class.php";

//front controller logica
// Autoload de clases
spl_autoload_register(function ($nameClass) {
    $classFile = './controllers/' . $nameClass . '.php';
    if (file_exists($classFile)) {
        include_once $classFile;
    } else {
        if ($nameClass != 'DefaultController') {
           // Manejar el caso en que el archivo de la clase no existe
            $responseData = new responseData;
            $responseError = $responseData->error_404();
            header('Content-Type: application/json'); //Enviar antes del json o en al inicio del controlador
            echo json_encode($responseError);
        } else {
            $response = [
                'status' => "Index",
                'result' => 'Estas en index'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
});

// Obtener la ruta de la URL
$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

// Separar la ruta en segmentos
$urlSegments = explode('/', trim($url, '/'));

// Obtener el nombre del controlador
$controllerName = !empty($urlSegments[1]) ? ucfirst($urlSegments[1]) : 'Default';

// Formar el nombre completo del controlador
$controllerClassName = $controllerName . 'Controller';

// Verificar si el controlador existe
if (class_exists($controllerClassName)) {
    // Crear una instancia del controlador
    $controller = new $controllerClassName();

    // Obtener el método (acción) a llamar
    $action = !empty($urlSegments[2]) ? $urlSegments[2] : 'index';

    // Verificar si el método existe en el controlador
    if (method_exists($controller, $action)) {
        // Llamar al método con los parámetros restantes de la URL
        $params = array_slice($urlSegments, 3);
        call_user_func_array([$controller, $action], $params);
    } else {
        // Método no encontrado, puedes manejar esto como desees
        echo "Método no encontrado";
    }
}
?>
