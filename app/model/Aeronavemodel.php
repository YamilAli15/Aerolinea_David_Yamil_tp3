<?php
require_once "app/model/Model.php";

class Administrador_tabla_de_aviones extends Model
{ //extension del model 

    function datos_de_tabla_de_Aeronave()
    { // tabla general de todos los vuelos 

        $db = $this->createConexion();


        $sentencia = $db->prepare("SELECT * FROM aerolineas_argentinas");
        $sentencia->execute();
        $vuelos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }
    function Filtrarporelpreciomayorelegido($Precio) {

        $db = $this->createConexion();
        $sentencia = $db->prepare("SELECT * FROM aerolineas_argentinas WHERE Precio >= ?");
        $sentencia->execute([$Precio]);
        $vuelos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }
 
    
    function insert_Aeronave($Aeronave, $Precio, $Fecha)
    {
        //abrimos la conexion;
        $db = $this->createConexion();

        //Enviar la consulta
        $resultado = $db->prepare("INSERT INTO aerolineas_argentinas (Aeronave,Precio,Fecha) VALUES (?,?,?)");
        $resultado->execute([$Aeronave, $Precio, $Fecha]); // ejecuta
    }


    function eliminarAeronave($id)
    {
        $db = $this->createConexion();
        $eliminado = $db->prepare("DELETE FROM aerolineas_argentinas WHERE ID = ?");
        $eliminado->execute([$id]); // ejecuta
    }



    function datos_de_un_Aeronave($id)
    {
        //abrimos la conexion;
        $db = $this->createConexion();

        //Enviar la consulta
        $sentencia = $db->prepare("SELECT * FROM aerolineas_argentinas WHERE id = ?");
        $sentencia->execute([$id]);
        $vuelos = $sentencia->fetch(PDO::FETCH_OBJ);
        return $vuelos;
    }
    function Lista_de_precio_de_manera_ascendente()
    { // tabla general de todos los vuelos 

        $db = $this->createConexion();


        $sentencia = $db->prepare("SELECT * FROM `aerolineas_argentinas` ORDER BY `aerolineas_argentinas`.`Precio` ASC");
        $sentencia->execute();
        $vuelos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }
    function Lista_de_precio_de_manera_Descendente()
    { // tabla general de todos los vuelos 

        $db = $this->createConexion();


        $sentencia = $db->prepare("SELECT * FROM `aerolineas_argentinas` ORDER BY `aerolineas_argentinas`.`Precio` DESC");
        $sentencia->execute();
        $vuelos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }

    function Actualizar_Aeronave($Aeronave,$Precio,$Fecha,$ID ) {
        $db = $this->createConexion();
        
        $resultado = $db->prepare("UPDATE aerolineas_argentinas SET Aeronave=?, Precio=?, Fecha=? WHERE ID  = ?");
        $resultado->execute([$Aeronave,$Precio,$Fecha,$ID]);
    }
  
}

