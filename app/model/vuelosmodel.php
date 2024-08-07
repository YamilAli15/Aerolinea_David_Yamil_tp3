<?php
require_once "app/model/Model.php";

class Administrador_tabla_de_vuelos extends Model
{ //extension del model 
    
    function datos_de_tabla_de_vuelos()
    { // tabla general de todos los vuelos 

        $db = $this->createConexion();


        $sentencia = $db->prepare("SELECT * FROM vuelos");
        $sentencia->execute();
        $vuelos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }
    function datos_de_tabla_de_vuelos_id($id)
    { // tabla general de todos los vuelos 

        $db = $this->createConexion();


        $sentencia = $db->prepare("SELECT * FROM vuelos v, aerolineas_argentinas a WHERE a.ID = v.id_aerolinea and a.ID = ?;");
        $sentencia->execute([$id]);
        $vuelos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $vuelos;
    }
    function datos_de_un_vuelos($ID_Vuelos)
    {
        //abrimos la conexion;
        $db = $this->createConexion();

        //Enviar la consulta
        $sentencia = $db->prepare("SELECT * FROM vuelos WHERE ID_Vuelos = ?");
        $sentencia->execute([$ID_Vuelos]);
        $vuelos = $sentencia->fetch(PDO::FETCH_OBJ);
        return $vuelos;
    }
    function insert_vuelo($Destino, $Pilotos, $id_aerolinea)
    {
        try {
            // Abrir la conexión (asumo que createConexion() devuelve un objeto PDO)
            $db = $this->createConexion();
    
            // Preparar la consulta SQL con marcadores de posición
            $resultado = $db->prepare("INSERT INTO vuelos (Destino, Pilotos, id_aerolinea) VALUES (?, ?, ?)");
    
            // Ejecutar la consulta con los valores proporcionados
            $resultado->execute([$Destino, $Pilotos, $id_aerolinea]);
    
            // Retornar el último ID insertado si es necesario
            return $db->lastInsertId();
        } catch (PDOException $e) {
            // Manejar cualquier error de la base de datos
            throw new Exception("Error al insertar el vuelo: " . $e->getMessage());
        }
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

    function Actualizar_vuelo($Destino, $Pilotos, $id_aerolinea, $ID_Vuelos ) 
    {
            $db = $this->createConexion();
            
            $resultado = $db->prepare("UPDATE vuelos SET Destino=?, Pilotos=?, id_aerolinea=? WHERE ID_Vuelos  = ?");
            $resultado->execute([$Destino, $Pilotos, $id_aerolinea, $ID_Vuelos ]);
    }
}