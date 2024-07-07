<?php
require_once 'app/controller/Controller.php';
require_once "app/model/vuelosmodel.php";
require_once "app/model/Aeronavemodel.php";

class Controlador_vuelos extends Controller
{

    private $model;
    
 


    public function __construct()
    {
        parent::__construct();
        $this->model = new Administrador_tabla_de_vuelos();
    }
   
    function Mostrar_tabla_de_vuelos() { 
        try {
            $vuelos = $this->model->datos_de_tabla_de_vuelos();
            if ($vuelos) {
                $response = [
                    "status" => 200,
                    "data" => $vuelos
                ];
                return $this->view->response($response, 200);
            } else {
                return $this->view->response("No hay tareas en la base de datos", 404);
            }
        } catch (Exception $e) {
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }

    function mostrarTablaDeVuelosID($params = null)
    {
         // Validar y obtener el ID
        if (!isset($params[':ID'])) {
            return $this->view->response("Parámetros inválidos", 400);
        }
    
        $id = $params[':ID'];
        
        try {
            // Obtener los datos de vuelos desde el modelo
            
            $vuelos = $this->model->datos_de_tabla_de_vuelos_id($id);
    
            if ($vuelos) {
                // Preparar la respuesta con datos de vuelos
                $response = [
                    "status" => 200,
                    "data" => $vuelos
                ];
                return $this->view->response($response, 200);
            } else {
                // Respuesta si no se encontraron vuelos
                return $this->view->response("No hay vuelos en la base de datos", 404);
            }
        } catch (Exception $e) {
            // Registrar el error para propósitos de debugging (opcional)
            error_log("Error en mostrarTablaDeVuelos: " . $e->getMessage());
    
            // En caso de error del servidor, devolver un mensaje con un código 500
            return $this->view->response("Error de servidor", 500);
        }
    }
// }
function insert_vuelo() {  
    // Obtener datos de la solicitud
    $tareaAeronave = $this->getData();
    
    // Validar datos
    if (empty($tareaAeronave->Destino) || empty($tareaAeronave->Pilotos) || empty($tareaAeronave->id_aerolinea)) {
        return $this->view->response("Datos incompletos", 400);
    }

    try {
        // Escapar datos para prevenir inyección de SQL
        $Destino = htmlspecialchars($tareaAeronave->Destino);
        $Pilotos = htmlspecialchars($tareaAeronave->Pilotos);
        $id_aerolinea = htmlspecialchars($tareaAeronave->id_aerolinea);
    
        // Insertar datos en la base de datos
        $lastId = $this->model->insert_vuelo($Destino, $Pilotos, $id_aerolinea);

        if ($lastId === false) {
            return $this->view->response("Error al insertar los datos.", 500);
        } else {
            // Responder con éxito y el ID del nuevo vuelo
            return $this->view->response("Se insertó correctamente con id: $lastId", 200);
        }
        
    } catch (Exception $e) {
        // Manejo de errores
        return $this->view->response("Error al insertar el vuelo: " . $e->getMessage(), 500);
    }
}

// } 

function actualizarVuelo($params = []){
    $id = $params[':ID'];
    $vuelos = $this->model->datos_de_un_vuelos($id);
    if($vuelos){
        $Vuelos = $this->getdata();
        if(isset($Vuelos->Destino) && isset($Vuelos->Pilotos) && isset($Vuelos->id_aerolinea)) {
            
            $Destino = $Vuelos->Destino;
            $Pilotos = $Vuelos->Pilotos;
            $id_aerolinea = $Vuelos->id_aerolinea;

            $this->model->Actualizar_vuelo($Destino,$Pilotos,$id_aerolinea,$id);
            $this->view->response(['msg:' => 'El Vuelos con el id: ' . $id . ' fue modificado'], 200);
        } else {
            $this->view->response(['msg:' => 'Faltan datos obligatorios para modificar o los datos ingresados no coinciden con los datos de la tabla'], 400);   
        }
    }
    else{
        $this->view->response(['msg:' => 'El Vuelos con el id: ' . $id . ' no existe'], 404);
    }
}


function eliminarvuelo($params=null) {
    try {
        if (!isset($params[':ID'])) {
            return $this->view->response("ID de aeronave no proporcionado:", 500);
        }
        
        $id = $params[':ID'];
        $Aeronave = $this->model->datos_de_un_vuelos($id);

        if ($Aeronave) {
            $this->model->eliminar_vuelo($id);
            $this->view->response(['msg' => 'El vuelo con id: ' . $id . ' ha sido borrado con éxito'], 200);
        } else {
            $this->view->response(['msg' => 'El vuelo con id: ' . $id . ' NO existe'], 404);
        }
    } catch (Exception $e) {
        // Captura y maneja excepciones
        return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
    }
}

}