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


    function mostrarTablaDeVuelos($params = null)
    {
        // Validar y obtener el ID
        if (!isset($params[':ID'])) {
            return $this->view->response("Parámetros inválidos", 400);
        }
    
        $id = $params[':ID'];
    
        try {
            // Obtener los datos de vuelos desde el modelo
            $vuelos = $this->modelvuelos->datosDeTablaDeVuelos($id);
    
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
    function insert_vuelo()
    {
        // Obtener datos de la solicitud
        $tareaAeronave = $this->getData();
    
        // Validar datos
        if (empty($tareaAeronave->Destino) || empty($tareaAeronave->Precio) || empty($tareaAeronave->id_aerolinea)) {
            return $this->view->response("Datos incompletos", 400);
        }
    
        try {
            // Insertar vuelo en la base de datos
            $lastId = $this->modelvuelos->insert_vuelo(
                $tareaAeronave->Destino,
                $tareaAeronave->Precio,
                $tareaAeronave->id_aerolinea
            );
    
            // Responder con éxito y el ID del nuevo vuelo
            return $this->view->response("Se insertó correctamente con id: $lastId", 200);
        } catch (Exception $e) {
            // Manejo de errores
            return $this->view->response("Error al insertar el vuelo: " . $e->getMessage(), 500);
        }
    }

    
    function Editar_tabla_de_vuelos($params = null) {
        // Validar que el parámetro ID esté presente
        if (!isset($params[':ID'])) {
            return $this->view->response("Faltan parámetros requeridos", 400);
        }
    
        $id = $params[':ID'];
    
        try {
            // Obtener los datos de la tabla de vuelos y la tabla de aeronaves
            $vuelos = $this->modelvuelos->tabla_de_vuelos($id);
            $aeronave = $this->modelAeronave->datos_de_tabla_de_Aeronave();
    
            // Verificar que ambos resultados sean válidos
            if ($aeronave && $vuelos) {
                // Formar la respuesta exitosa con los datos obtenidos
                $response = [
                    "status" => 200,
                    "data" => [
                        "aeronave" => $aeronave,
                        "vuelos" => $vuelos
                    ]
                ];
                return $this->view->response($response, 200);
            } else {
                // Responder con error si alguna de las consultas falló
                return $this->view->response("Hubo un error en una de las dos bases de datos", 404);
            }
        } catch (PDOException $e) {
            // Manejo de excepciones específicas de la base de datos
            return $this->view->response("Error en la base de datos: " . $e->getMessage(), 500);
        } catch (Exception $e) {
            // Manejo de excepciones generales
            return $this->view->response("Error de servidor: " . $e->getMessage(), 500);
        }
    }
} 
