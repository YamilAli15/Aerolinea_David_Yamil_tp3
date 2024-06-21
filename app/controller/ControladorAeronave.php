<?php


require_once('app/view/JSONView.php');
require_once ("app/model/Aeronavemodel.php");
class Controlador_Aeronave
{

    private $model;
    private $view;    
    private $data;


    public function __construct()
    {
       
        $this->view = new JSONView();
        $this->model = new Administrador_tabla_de_aviones(); 
        $this->data = file_get_contents("php://input");
    }
    private function getData() {
        return json_decode($this->data);
    }

    function Mostrar_tabla_de_aviones()
    { 
        try{
        $Aeronave = $this->model->datos_de_tabla_de_Aeronave();
        if($Aeronave){
            $response = [
            "status" => 200,
            "data" => $Aeronave
           ];
           return  $this->view->response($response, 200);

        }else{
            return  $this->view->response("No hay tareas en la base de datos", 404);
        }
        

    }catch (Exception $e) {
            return  $this->view->response("Error de servidor", 500);
        }

    }

    function Filtrar_por_el_precio_mayor_elegido($params=null)
    { $pecio = $params[':pecio'];
        try{
        $Aeronave = $this->model->Filtrar_por_el_precio_mayor_elegido($pecio);
        if($Aeronave){
            $response = [
            "status" => 200,
            "data" => $Aeronave
           ];
           return  $this->view->response($response, 200);

        }else{
            return $this->view->response("No hay tareas en la base de datos", 404);
        }
        

    }catch (Exception $e) {
            return  $this->view->response("Error de servidor", 500);
        }

    }



    function eliminarAeronave($params=null)
    { $id = $params[':ID'];
        try {

        $Aeronave = $this->model->datos_de_tabla_de_Aeronave($id);
            if($Aeronave){
                $Aeronave=$this->model->eliminarAeronave($id);
            //    $this->view->response($response, 200);
           return $this->view->response("Aeronave $id, eliminada", 200);
              
            } else{
                return  $this->view->response("Aeronave $id, no encontrada", 404);
            }
              
            
    
       
        }    catch (Exception $e) {
            return $this->view->response("Error de servidor", 500);
        }
    }
    function insert_Aeronave()
    {
        $tareaAeronave = $this->getData();
            
        $lastId = $this->model->insert_Aeronave(
                        $tareaAeronave->Aeronave, 
                        $tareaAeronave->Precio, 
                        $tareaAeronave->Fecha);
        
                        return  $this->view->response("Se insertó correctamente con id: $lastId", 200);
        
            }
               
     
    }
