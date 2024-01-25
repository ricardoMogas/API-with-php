<?php

require_once(__DIR__ . '/../core/conexionDB.php');
require_once(__DIR__ . "/../core/responseData.class.php");

final class UserModel extends  ConexionDB
{
    function __construct(Type $var = null)
    {
        $this->var = $var;
    }
    
    public function getUser()
    {
        $query = "SELECT * FROM user";
        $data = parent::getData($query);
        return $data;
    }

    public function postUser()
    {}


}


?> 