<?php

require_once "app/view/AvionesView.php";
require_once "app/model/vuelosmodel.php";
require_once "app/model/Aeronavemodel.php";

class Controlador_vuelos
{

    private $modelvuelos;
    private $view;
    private $modelAeronave;


    public function __construct()
    {
        $this->modelvuelos = new Administrador_tabla_de_vuelos();
        $this->view = new AvionesView();
        $this->modelAeronave = new Administrador_tabla_de_aviones();
    }



    function Mostrar_tabla_de_vuelos($id)
    {
        if(!empty($id)){
            if(!empty($modelvuelos)){
             $vuelos = $this->modelvuelos->datos_de_tabla_de_vuelos($id);
                if(!empty($vuelos)){
                 $this->view->tabla_de_vuelo($vuelos);
                }else{
                $this->view->Error("No se encontró el vuelo en la base de datos",401);
                }        
            }else{
                $this->view->Error("Problemas con la base de datos",404);
            }
        }
        else{
            $this->view->Error("Faltan datos");
            }
        

       
    }
    function eliminarvuelos($id=null)
    {
        if(!empty($id)){
            if(!empty($modelvuelos)){
                 $this->modelvuelos->eliminar_vuelo($id); 
                 header("Location:" . BASE_URL . "Tabla");
            }else{
                $this->view->Error("Problemas con la base de datos",404);
            }

        }else{
            $this->view->Error("Faltan datos");
        }
       
       
    }
    function insert_vuelo()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                !empty($_POST['Destino']) && !empty($_POST['Pilotos'])
                && !empty($_POST['id_aerolinea'])
            ) {

                $Destino = $_POST['Destino'];
                $Precio = $_POST['Pilotos'];
                $id_aerolinea = $_POST['id_aerolinea'];
                $this->modelvuelos->insert_vuelo($Destino, $Precio, $id_aerolinea);
                header("Location:" . BASE_URL . "TablaDeVuelos");
            } else {
                $this->view->Error("Faltan datos");
            }
        }
    }
   function Editar_tabla_de_vuelos(){
    
    $Aeronave = $this->modelAeronave->datos_de_tabla_de_Aeronave();
    $vuelos = $this->modelvuelos->tabla_de_vuelos();
    $this->view->Editar_tabla_de_vuelos($vuelos,$Aeronave);
   }
}
