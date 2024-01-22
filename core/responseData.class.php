<?php

class responseData {

    private $response = [
        'status' => "ok",
        'result' => array()
    ];
    
    public function sendJsonResponse($status, $data){
        $this->response['status'] = $status;
        $this->response['result'] = $data;
        return $this->response;
    }

    public function error_200($value = "Datos incorrectos") {
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '200',
            'error_msg' => $value
        );
        return $this->response;
    }

    public function error_400() {
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '400',
            'error_msg' => 'Nombre de datos incorrecto o formato incorrecto'
        );
        return $this->response;
    }

    public function error_401() {
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '401',
            'error_msg' => 'No autorizado'
        );
        return $this->response;
    }

    public function error_403() {
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '403',
            'error_msg' => 'Acceso prohibido'
        );
        return $this->response;
    }

    public function error_404() {
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '404',
            'error_msg' => 'Recurso no encontrado'
        );
        return $this->response;
    }

    public function error_405() {
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '405',
            'error_msg' => 'Método no permitido'
        );
        return $this->response;
    }

    // Agrega más métodos de error según sea necesario

}
?>
