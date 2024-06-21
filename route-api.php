<?php
    require_once('libs/Router.php');
    require_once('app/controller/ControladorAeronave.php');
    require_once('app/controller/Controladorvuelos.php');

    $router = new Router();

    // GET http://localhost/api/aerolineas
    $router->addRoute('AerolineAsaviones', 'GET', 'Controlador_Aeronave', 'Mostrar_tabla_de_aviones');

    // $router->addRoute('aerolíneas/:ID', 'GET', 'Controlador_vuelos', 'Mostrar_tabla_de_vuelos');

    $router->addRoute('AerolíneasVuelos/:ID', 'PUT', 'Controlador_vuelos', 'Editar_tabla_de_vuelos');


    $router->addRoute('AerolíneasAsaviones/:pecio', 'GET', 'Controlador_vuelos', 'Filtrar_por_el_precio_mayor_elegido');

    $router->addRoute('AerolíneasAeronave', 'POST', 'Controlador_Aeronave', 'insert_Aeronave');

     
     $router->addRoute('AerolíneasVuelo', 'POST', 'Controlador_vuelos', 'insert_vuelo');
  
     $router->addRoute('aerolíneasAeronave/:ID', 'DELETE', 'Controlador_Aeronave', 'eliminarAeronave');

     $router->addRoute('aerolíneasVuelos/:ID', 'DELETE', 'Controlador_vuelos', 'eliminarVuelos');
     
    // $router->addRoute('tareas/:ID', 'PUT', 'TaskApiController', 'finalizaTarea');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
