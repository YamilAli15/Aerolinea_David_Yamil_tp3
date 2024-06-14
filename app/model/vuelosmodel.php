<?php
require_once "app/model/Model.php";

class Administrador_tabla_de_vuelos extends Model
{ //extension del model 

    function datos_de_tabla_de_vuelos($id)
    { // tabla general de todos los vuelos 

        $db = $this->createConexion();


        $sentencia = $db->prepare("SELECT * FROM vuelos v, aerolineas_argentinas a WHERE a.ID = v.id_aerolinea and a.ID = ?;");
        $sentencia->execute([$id]);
        $vuelos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }


    function insert_vuelo($Destino, $Precio, $id_aerolinea)
    {
        //abrimos la conexion;
        $db = $this->createConexion();

        //Enviar la consulta
        $resultado = $db->prepare("INSERT INTO vuelos ($Destino,$Precio,$id_aerolinea ) VALUES (?,?,?)");
        $resultado->execute([$Destino, $Precio, $id_aerolinea]); // ejecuta
    }

    function eliminar_vuelo($id)
    {
        $db = $this->createConexion();
        $eliminado = $db->prepare("DELETE FROM vuelos WHERE ID_Vuelos = ?");
        $eliminado->execute([$id]); // ejecuta
    }


    function tabla_de_vuelos()
    { // tabla general de todos los vuelos 

        $db = $this->createConexion();


        $sentencia = $db->prepare("SELECT * FROM vuelos");
        $sentencia->execute();
        $vuelos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }


}
