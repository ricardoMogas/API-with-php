<?php
// Habilitar CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
require_once(__DIR__ . '/../core/conexionDB.php');
require_once(__DIR__ . "/../core/responseData.class.php");



class GetUserController extends ConexionDB 
{
    public function index() 
    {
        $_response = new responseData;
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $data = $this->getUser();
            $responseOk = $_response->sendJsonResponse("ok", $data);
            echo json_encode($responseOk);
        } else {
            echo "Metodo no permitido";
        }
    }

    private function getUser()
    {
        $query = "SELECT * FROM user";
        $data = parent::getData($query);
        if (isset($data)) {
            return $data;
        } else {
            return 0;
        }
    }
}
?>

