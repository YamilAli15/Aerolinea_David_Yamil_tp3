<?php

require_once "app/view/AvionesView.php";

require_once "app/model/Aeronavemodel.php";
class Controlador_Aeronave
{

    private $model;
    private $view;


    public function __construct()
    {

        $this->view = new AvionesView();
        $this->model = new Administrador_tabla_de_aviones();
    }

    function Show_Admin_noadmin_table()
    { // 

        $Aeronave = $this->model->datos_de_tabla_de_Aeronave();

        $this->view->tabla_de_Aeronave($Aeronave); //guarda en esa variante para pasarsela a la view   

        header("Lcation:" . BASE_URL . "login");
    }






    function eliminarAeronave($id)
    {
        $this->model->eliminarAeronave($id);
        header("Location:" . BASE_URL . "Tabla");
    }

    function insert_Aeronave()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                !empty($_POST['Aeronave']) && !empty($_POST['Precio']) && !empty($_POST['Fecha'])
            ) {

                $Aeronave = $_POST['Aeronave'];
                $Precio = $_POST['Precio'];
                $Fecha = $_POST['Fecha'];
                $this->model->insert_Aeronave($Aeronave, $Precio, $Fecha);
                header("Location:" . BASE_URL . "Tabla");
            } else {
                $this->view->Error("Faltan datos");
            }
        }
    }
}
