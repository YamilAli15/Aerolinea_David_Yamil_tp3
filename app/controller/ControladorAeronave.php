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

    function Mostrar_tabla_de_aviones() { 
        try {
            $Aeronave = $this->model->datos_de_tabla_de_Aeronave();
            if ($Aeronave) {
                $response = [
                    "status" => 200,
                    "data" => $Aeronave
                ];
                return $this->view->response($response, 200);
            } else {
                return $this->view->response("No hay tareas en la base de datos", 404);
            }
        } catch (Exception $e) {
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }

    function Listar_por_precio($params=null){
       // Validar que el parámetro está presente
    if (!isset($params[':Posicióndelatabla'])) {
        return $this->view->response("Parámetro no proporcionado", 500);
    }

    $CondiciónDeLaLista = $params[':Posicióndelatabla'];

    try {
        // Función interna para manejar la respuesta
        $handleResponse = function($data) {
            if ($data) {
                return $this->view->response([
                    "status" => 200,
                    "data" => $data
                ], 200);
            } else {
                return $this->view->response("No hay tareas en la base de datos", 404);
            }
        };

        switch (strtolower($CondiciónDeLaLista)) {
            case 'ascendente':
                $Aeronave = $this->model->Lista_de_precio_de_manera_ascendente();
                return $handleResponse($Aeronave);

            case 'descendente':
                $Aeronave = $this->model->Lista_de_precio_de_manera_descendente();
                return $handleResponse($Aeronave);

            default:
                return $this->view->response("Error de parámetro inválido", 500);
        }

    } catch (Exception $e) {
        return $this->view->response("Error de servidor: " . $e->getMessage(),500);
    }
}
    









    public function Filtrar_por_el_precio_mayor_elegido($params = null) {
        $precio = $params[':precio'];
        
        if (is_null($precio) || $precio === '') {
            return $this->view->response("El parámetro 'precio' es requerido", 400);
        }

        try {
            $Aeronave = $this->model->Filtrarporelpreciomayorelegido($precio);
            if ($Aeronave) {
                $response = [
                    "status" => 200,
                    "data" => $Aeronave
                ];
                return $this->view->response($response, 200);
            } else {
                return $this->view->response("No hay aeronaves en la base de datos", 404);
            }
        } catch (Exception $e) {
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
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
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }
    function insert_Aeronave()
    {
        // Obtener datos de entrada
        $tareaAeronave = $this->getData();
    
        // Validar datos de entrada
        if (!isset($tareaAeronave->Aeronave) || !isset($tareaAeronave->Precio) || !isset($tareaAeronave->Fecha)) {
            return $this->view->response("Faltan datos requeridos.", 400);
        }
    
        // Sanitizar y escapar los datos de entrada (por seguridad)
        $Aeronave = htmlspecialchars($tareaAeronave->Aeronave);
        $Precio = htmlspecialchars($tareaAeronave->Precio);
        $Fecha = htmlspecialchars($tareaAeronave->Fecha);
    
        // Insertar datos en la base de datos
        $lastId = $this->model->insert_Aeronave($Aeronave, $Precio, $Fecha);
    
        // Manejo de errores
        if ($lastId === false) {
            return $this->view->response("Error al insertar los datos.", 500);
        }
    
        // Éxito
        return $this->view->response("Se insertó correctamente con id: $lastId", 200);
    }
}
