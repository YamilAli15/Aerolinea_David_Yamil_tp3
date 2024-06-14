
<?php
require_once "app/view/view.php";
// La View es una sola porque nos concentramos en el backin No sé si está bien dicho 😅


class AvionesView extends View
{


  function Error($msj = null)
  {

    $this->smarty->assign("msj", $msj);
    $this->smarty->display('error.tpl');
  }

  function login($msj = null)
  {


    $this->smarty->display('NavigationBar.tpl');
    $this->smarty->assign("msj", $msj);
    $this->smarty->display('login.tpl');
  }

  function Homepage()
  {



    $this->smarty->display('NavigationBar.tpl');
    $this->smarty->display('Home.tpl');
  }
  function tabla_de_Aeronave($Aeronave)
  {

    $this->smarty->assign('cantidad', count($Aeronave));
    $this->smarty->assign('Aeronave', $Aeronave);
    $this->smarty->display('AeronaveTables.tpl');
  }

  function tabla_de_vuelo($vuelos)
  {


    $this->smarty->assign('cantidad', count($vuelos));
    $this->smarty->assign('vuelos', $vuelos);
    $this->smarty->display('vuelosTables.tpl');
  }
  function Editar_tabla_de_vuelos($vuelos,$Aeronave)
  {


    $this->smarty->assign('cantidad', count($vuelos));
    $this->smarty->assign('vuelos', $vuelos);
    $this->smarty->assign('Aeronave', $Aeronave);
    $this->smarty->display('Editartabladevuelos.tpl');
  }
}


?>
  
