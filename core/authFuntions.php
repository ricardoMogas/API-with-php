<?php
require_once "conexionDB.php";
require_once "responseData.class.php";

final class auth extends ConexionDB
{

    public function login($json)
    {
        $responseData = new responseData;
        $data = $json;
        if ( !isset($data['user']) || !isset($data['password']) ){
            // Si no estan los siguientes campos entonces eror 400
            return $responseData->error_400();
        }else{
            // si estan los campos entonces determinar si la contraseña
            // es correcata
            $usuario = $data['user'];
            $contraseña = $data['password'];
            $data = $this->getUser($usuario);
            $password = $data[0]['password'];
            if ( $data && $password == $contraseña ) {
                $response = [
                    'status' => "ok",
                    'id' => $data[0]['id']
                ];
                return $response;
            }else{
                return $responseData->error_200("No existe: '$usuario' o password incorrecta");
            }
        }
    }

    //Obtener usuario por medio del nombres
    private function getUser($name)
    {
        $query = "SELECT * FROM user WHERE name = '$name'";
        $data = parent::getData($query); //parent referencia a la clase padre extends ConexionDB
        if (isset($data[0]['id'])) {
            return $data;
        }else{
            return 0; //es igual a false
        }
    }

}

?>