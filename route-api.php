<?php
    require_once('libs/Router.php');
    require_once('app/controller/ControladorAeronave.php');
    require_once('app/controller/Controladorvuelos.php');

    $router = new Router();

    // GET http://localhost/api/aerolineas
    $router->addRoute('TablaDeAviones', 'GET', 'Controlador_Aeronave', 'Mostrar_tabla_de_aviones');//ok

    $router->addRoute('TablaDeVuelo/:ID', 'GET', 'Controlador_vuelos', 'Mostrar_tabla_de_vuelos');

    $router->addRoute('EditarVuelo/:ID', 'PUT', 'Controlador_vuelos', 'Editar_tabla_de_vuelos');


    $router->addRoute('TablaDeAvionesPorPrecio/:precio', 'GET', 'Controlador_Aeronave', 'Filtrar_por_el_precio_mayor_elegido');


    $router->addRoute('TablaDeAviones', 'POST', 'Controlador_Aeronave', 'insert_Aeronave');

     
     $router->addRoute('TablaDeVuelo', 'POST', 'Controlador_vuelos', 'insert_vuelo');
  
     $router->addRoute('TablaDeAviones/:ID', 'DELETE', 'Controlador_Aeronave', 'eliminarAeronave');

     $router->addRoute('TablaDeVuelo/:ID', 'DELETE', 'Controlador_vuelos', 'eliminarVuelos');

     $router->addRoute('TablaDeAvionesPorPrecio/:Posicióndelatabla', 'GET', 'Controlador_Aeronave', 'Listar_por_precio');//ok
      
    // $router->addRoute('tareas/:ID', 'PUT', 'TaskApiController', 'finalizaTarea');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
