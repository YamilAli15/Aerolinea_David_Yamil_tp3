<?php
    require_once('libs/Router.php');
    require_once('app/controller/ControladorAeronave.php');
    require_once('app/controller/Controladorvuelos.php');

    $router = new Router();

    //localhost/api/Aviones
    $router->addRoute('Aviones', 'GET', 'Controlador_Aeronave', 'Mostrar_tabla_de_aviones');

    $router->addRoute('Aviones/:ID', 'GET', 'Controlador_Aeronave', 'Listar_por_precio');

    $router->addRoute('Aviones/:ID', 'GET', 'Controlador_Aeronave', 'Filtrar_por_el_precio_mayor_elegido');

    $router->addRoute('Aviones/:ID', 'DELETE', 'Controlador_Aeronave', 'eliminarAeronave');

    $router->addRoute('Aviones', 'POST', 'Controlador_Aeronave', 'insert_Aeronave');

//localhost/api/vuelos
    $router->addRoute('Vuelos/:ID', 'GET', 'Controlador_vuelos', 'mostrarTablaDeVuelos');

    $router->addRoute('vuelos', 'POST', 'Controlador_vuelos', 'insert_vuelo');

    $router->addRoute('Vuelos/:ID', 'PUT', 'Controlador_vuelos', 'actualizarVuelo');

    $router->addRoute('login', 'POST', 'loginController', 'login');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
