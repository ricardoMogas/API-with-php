<?php
// Habilitar CORS
require_once(__DIR__ . '/../core/conexionDB.php');
require_once(__DIR__ . "/../core/responseData.class.php");

class GetUserController {
    public function index() 
    {
        /** REALIZAR ACCIONES DEL CONTROLADOR AQUI */
        $responseData = new responseData;
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user = $this->getUser();
            if ($user) {
                $response = $responseData->sendJsonResponse('ok', $user);
                echo json_encode($response);
            } else {
                $response = $responseData->sendJsonResponse("error", "No se encontraron datos");
                echo json_encode($response);
            }
        } else {
            $response = $responseData->error_400();
            echo json_encode($response);
        }
    }

    private function getUser()
    {
        //crear datos domy para pruebas que asemejen a los datos optenido de la base de datos
        $data = array(
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
        );
        //$query = "SELECT * FROM user";
        //$data = parent::getData($query);
        if (isset($data)) {
            return $data;
        } else {
            return 0;
        }
    }
}
?>

