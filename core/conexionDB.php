<?php
include('config.php');

class ConexionDB {
    private $host;
    private $username;
    private $password;
    private $db;
    private $conexion;

    //constructor 
    public function __construct() {
        $this->host = DB_HOST;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
        $this->db = DB_NAME;
        $this->conectar(); // Conecta al construir el objeto
    }

    public function conectar(){
        $this->conexion = new mysqli($this->host, $this->username, $this->password, $this->db);
        if ($this->conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conexion->connect_error);        
        }
        //echo "Conexion establecida.";
    }
    // Método para cerrar la conexión a la base de datos
    public function cerrar() {
        if ($this->conexion) {
            $this->conexion->close();
            //echo "Conexión a la base de datos cerrada.";
        }
    }
    //metodo para convertir UTF8
    private function convertUTF8($array) {
        array_walk_recursive($array, function(&$item, $key){
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $array;
    }
    //metodo para realizar consultas mas facilmente
    public function getData($sqlstr) {
        try {
            $stmt = $this->conexion->prepare($sqlstr); //evitar inyecciones de codigo
            if ($stmt === false) {
                throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $resultArray = $result->fetch_all(MYSQLI_ASSOC);//función para convertir consultas hechas directamente en arreglos

            return $this->convertUTF8($resultArray);
        } catch (Exception $e) {
            throw new Exception("Error al obtener datos: " . $e->getMessage());
        }
    }
    //metodo para insertar datos
    public function insertData($sqlstr){
        try {
            // Verificar si la consulta comienza con "INSERT"
            if (stripos(trim($sql), 'insert') === 0) {
                $stmt = $this->conexion->prepare($sql);
                if ($stmt === false) {
                    throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
                }

                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Solo se permiten consultas INSERT.");
            }
        } catch (Exception $e) {
            throw new Exception("Error al ejecutar el query: " . $e->getMessage());
        }
    }
    //metodo para incertar pero que devuelve el id
    public function insertDataId($sqlstr){
        try {
            // Verificar si la consulta comienza con "INSERT"
            if (stripos(trim($sqlstr), 'insert') === 0) {
                $stmt = $this->conexion->prepare($sqlstr);
                if ($stmt === false) {
                    throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
                }

                $stmt->execute();
                $insertId = $stmt->insert_id;  // Obtener el ID de la fila insertada
                $stmt->close();

                return $insertId;
            } else {
                throw new Exception("Solo se permiten consultas INSERT.");
            }
        } catch (Exception $e) {
            throw new Exception("Error al ejecutar el query: " . $e->getMessage());
        }
    }
}
?>