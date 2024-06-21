<?php
require_once('app/view/JSONView.php');
require_once "app/model/vuelosmodel.php";
require_once "app/model/Aeronavemodel.php";

class Controlador_vuelos
{

    private $modelvuelos;
    private $view;
    private $modelAeronave; 
    private $data;


    public function __construct()
    {
        $this->modelvuelos = new Administrador_tabla_de_vuelos();
        $this->modelAeronave = new Administrador_tabla_de_aviones();
        $this->view = new JSONView();
        $this->data = file_get_contents("php://input");

    }
    private function getData() {
        return json_decode($this->data);
    }


    function Mostrar_tabla_de_vuelos($params=null)
    {  $id = $params[':ID'];
        try{
          
            $vuelos = $this->modelvuelos->datos_de_tabla_de_vuelos($id);
            if($vuelos){
                $response = [
                "status" => 200,
                "data" => $vuelos
               ];
               return   $this->view->response($response, 200);
    
            }else{
                return $this->view->response("No hay tareas en la base de datos", 404);
            }
            
            // $this->view->tabla_de_Aeronave($Aeronave); //guarda en esa variante para pasarsela a la view  
    
        }catch (Exception $e) {
                // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
                return $this->view->response("Error de servidor", 500);
            }
    
    }
    function insert_vuelo()
    {
        $tareaAeronave = $this->getData();
            
        $lastId = $this->modelvuelos->insert_vuelo(
                        $tareaAeronave-> Destino,
                        $tareaAeronave-> Precio,
                        $tareaAeronave->id_aerolinea);
               
              
            return  $this->view->response("Se insertó correctamente con id: $lastId", 200);
            
    }
   function Editar_tabla_de_vuelos(){
    try{
        $vuelos = $this->modelvuelos->tabla_de_vuelos();
        $Aeronave = $this->modelAeronave->datos_de_tabla_de_Aeronave();
        if($Aeronave && $vuelos){
            $responseA = [
            "status" => 200,
            "data" => $Aeronave
           ];
           $responseB =
           [
            "status" => 200,
            "data" => $vuelos
           ];
           return  $this->view->response($responseA,$responseB, 200);

        }else{
            return  $this->view->response("Hubo un error en una de las dos bases de datos", 404);
        }
       
    
    } catch (Exception $e) {
            
            $this->view->response("Error de servidor", 500);
        }
   }
}
