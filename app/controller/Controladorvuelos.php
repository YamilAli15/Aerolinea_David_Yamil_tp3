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

        $vuelos = $this->modelvuelos->datos_de_tabla_de_vuelos($id);

        $this->view->tabla_de_vuelo($vuelos);
    }
    function eliminarvuelos($id)
    {
        $this->modelvuelos->eliminar_vuelo($id);
        header("Location:" . BASE_URL . "Tabla");
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
