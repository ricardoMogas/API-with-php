<?php
class FrontController {
    private $controller;

    public function __construct() {
        // Obtener la ruta de la URL
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        
        // Separar la ruta en segmentos
        $urlSegments = explode('/', trim($url, '/'));

        // Obtener el nombre del controlador
        $controllerName = !empty($urlSegments[1]) ? ucfirst($urlSegments[1]) : 'Default';

        // Formar el nombre completo del controlador
        $controllerClassName = $controllerName . 'Controller';

        // Verificar si la clase del controlador existe
        if (class_exists($controllerClassName)) {
            // Instanciar el controlador
            $this->controller = new $controllerClassName();
        } else {
            // Si no existe, utilizar un controlador por defecto o mostrar un error
            $this->controller = new DefaultController();
        }
    }

    public function run() {
        // Obtener la acción de la URL, o usar 'index' por defecto
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        // Agregar una acción por defecto si no se proporciona ninguna
        if (!method_exists($this->controller, $action)) {
            $action = 'index';
        }

        // Obtener parámetros de la URL
        $urlParams = array_slice(explode('/', trim($_SERVER['REQUEST_URI'], '/')), 2);

        // Ejecutar el método del controlador con los parámetros
        $this->controller->{$action}(...$urlParams);
    }
}



class DefaultController {
    public function index() {
        echo "Página de inicio";
    }

    public function about() {
        echo "Acerca de nosotros";
    }
}

class OtherController {
    public function someAction() {
        echo "Alguna acción";
    }
}

class UserController {
    public function getUser($userId) {
        echo "Obteniendo información del usuario con ID $userId";
    }
}

// Uso del FrontController
/*
    $frontController = new FrontController();
    $frontController->run();
*/