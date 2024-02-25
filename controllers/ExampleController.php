<?php
require_once(__DIR__ . '/../core/conexionDB.php');
require_once(__DIR__ . "/../core/responseData.class.php");

class ExampleController {
    public function index() {
        /** REALIZAR ACCIONES DEL CONTROLADOR AQUI */
    }
    
    public function doGet(...$params) {
        // control de errores por si no te trae el name en el parametro
        /*
        if (!isset($params["name"])) {
            $response = new ResponseData();
            $responseError = $response->error_400();
            echo json_encode($responseError);
            return;
        }
        */

        $data = array(
            "name" => "Ricardo",
            "data" => [
                array(
                    "id" => 1,
                    "name" => "Ricardo",
                    "password" => "1234"
                ),
                array(
                    "id" => 2,
                    "name" => "Maria",
                    "password" => "5678"
                ),
                array(
                    "id" => 3,
                    "name" => "Juan",
                    "password" => "abcd"
                ),
                array(
                    "id" => 4,
                    "name" => "Ana",
                    "password" => "efgh"
                )
            ]
        );
        if (isset($data)) {
            echo json_encode($data);
        } else {
            $response = new ResponseData();
            $responseError = $response->error_404();
            echo $responseError;
        }
    }
}
?>