<?php
require_once "app/model/Model.php";

class datos_de_usuarios extends Model
{



    function usuarios($name)
    {

        $db = $this->createConexion();

        $sentencia = $db->prepare("SELECT * FROM users WHERE name = ?");
        $sentencia->execute([$name]);
        $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }
}
