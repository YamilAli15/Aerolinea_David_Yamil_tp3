<?php


require_once 'app/controller/Controller.php';
require_once ("app/model/Aeronavemodel.php");
class Controlador_Aeronave extends Controller
{

    private $model;
 
  


    public function __construct()
    {
        parent::__construct();
        $this->model = new Administrador_tabla_de_aviones(); 
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
    if (!isset($params[':ID'])) {
        return $this->view->response("Parámetro no proporcionado", 500);
    }

    $CondiciónDeLaLista = $params[':ID'];

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
// }


function Filtrar_por_el_precio_mayor_elegido($params = null) {
       

    $precio = $params[':ID'];
    
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

    


    function eliminarAeronave($params=null) {
        try {
            if (!isset($params[':ID'])) {
                return $this->view->response("ID de aeronave no proporcionado:", 500);
            }
            
            $id = $params[':ID'];
            $Aeronave = $this->model->datos_de_un_Aeronave($id);
    
            if ($Aeronave) {
                $this->model->eliminarAeronave($id);
                $this->view->response(['msg' => 'El Aeronave con id: ' . $id . ' ha sido borrado con éxito'], 200);
            } else {
                $this->view->response(['msg' => 'El Aeronave con id: ' . $id . ' NO existe'], 404);
            }
        } catch (Exception $e) {
            // Captura y maneja excepciones
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }
    


    function insert_Aeronave()
    { 
        // Obtener datos de entrada
        $tareaAeronave = $this->getData();
    //   var_dump($tareaAeronave);die;

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
        return $this->view->response("Se insertó correctamente: $lastId",200);
    }

    function actualizarAeronave($params = []){
        $id = $params[':ID'];
        $Aeronave = $this->model->datos_de_un_Aeronave($id);
        if($Aeronave){
            $Vuelos = $this->getdata();
            if(isset($Vuelos->Aeronave	) && isset($Vuelos->Precio) && isset($Vuelos->Fecha)) {
                
                $Aeronave= $Vuelos->Aeronave	;
                $Precio = $Vuelos->Precio;
                $Fecha = $Vuelos->Fecha;
    
                $this->model->Actualizar_Aeronave($Aeronave	,$Precio,$Fecha,$id);
                $this->view->response(['msg:' => 'la Aeronave con el id: ' . $id . ' fue modificado'], 200);
            } else {
                $this->view->response(['msg:' => 'Faltan datos obligatorios para modificar o los datos ingresados no coinciden con los datos de la tabla'], 400);   
            }
        }
        else{
            $this->view->response(['msg:' => 'la Aeronave con el id: ' . $id . ' no existe'], 404);
        }
    }
    
    
    
}




