<?php
require_once "core/ConexionDB.php";

class FrontController
{
    private $checkSession = true; // Indica si se debe verificar la sesión

    public function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
        $this->handleRouting();
    }

    public function isSessionStarted()
    {
        return $this->checkSession && isset($_SESSION['user_id']);
    }

    private function autoload($nameClass)
    {
        $classFile = './controllers/' . $nameClass . '.php';
        if (file_exists($classFile)) {
            include_once $classFile;
        } else {
            $this->handleClassNotFound($nameClass);
        }
    }

    private function handleClassNotFound($nameClass)
    {
        if ($nameClass != 'HelpController') {
            $responseError = array(
                'status' => 'error',
                'result' => array(
                    'error_id' => '404',
                    'error_msg' => 'Clase no encontrada'
                )
            );
            header('Content-Type: application/json');
            echo json_encode($responseError);
        } else {
            $controller = new HelpController();
        }
    }

    private function goToController($url, $urlSegments, $action){
        $params = array();
        // saber si el segmento de la url tiene un ? para saber si tiene parametros
        $NameComplete = !empty($urlSegments[1]) ? ucfirst($urlSegments[1]) : 'Help';
        if (strpos($NameComplete, '?') !== false) {
            // todo lo que este antes del ? en el segmento de la url
            $controllerName = strstr($NameComplete, '?', true); 
            // obtener los parametros de la url
            $urlComponents = parse_url($url);
            parse_str($urlComponents['query'], $params);
        } else {
            $controllerName = $NameComplete;
        }
        $controllerClassName = $controllerName . 'Controller';
        if (class_exists($controllerClassName)) {
            $controller = new $controllerClassName();
            //codigo ates del if
            if (method_exists($controller, $action)) {
                call_user_func_array([$controller, $action], $params);
            } else if(method_exists($controller, 'index')) {
                $action = 'index';
                call_user_func_array([$controller, $action], $params);
            } else {
                echo "Método Index no encontrado, declarar método index en el controlador";
            }
        }
    }

    private function handleRouting()
    {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $action = !empty($urlSegments[2]) ? $urlSegments[2] : 'index';
        $method = $_SERVER['REQUEST_METHOD'];
        $urlSegments = explode('/', trim($url, '/'));
        switch ($method) {
            case 'GET':
                $action = 'doGet';
                $this->goToController($url, $urlSegments, $action);
                break;
            case 'POST':
                $action = 'doPost';
                $this->goToController($url, $urlSegments, $action);
                break;
            case 'PUT':
                $action = 'doPut';
                $this->goToController($url, $urlSegments, $action);
                break;
            case 'DELETE':
                $action = 'doDelete';
                $this->goToController($url, $urlSegments, $action);
                break;
            default:
                echo "Método no soportado";
                break;
        }
        
    }
}
