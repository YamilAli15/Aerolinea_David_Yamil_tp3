<?php
    require_once('libs/Router.php');
    require_once('app/controller/ControladorAeronave.php');
    require_once('app/controller/Controladorvuelos.php');

    $router = new Router();

    // GET http://localhost/api/aerolineas
    $router->addRoute('TablaDeAviones', 'GET', 'Controlador_Aeronave', 'Mostrar_tabla_de_aviones');

    $router->addRoute('ListarPorPrecio/:ID', 'GET', 'Controlador_Aeronave', 'Listar_por_precio');

    $router->addRoute('FiltrarPorPrecioMayorElegido/:precio', 'GET', 'Controlador_Aeronave', 'Filtrar_por_el_precio_mayor_elegido');

    $router->addRoute('EliminarAeronave:ID', 'DELETE', 'Controlador_Aeronave', 'eliminarAeronave');

    $router->addRoute('InsertarAeronave', 'POST', 'Controlador_Aeronave', 'insert_Aeronave');

    $router->addRoute('TablaDeVuelo/:ID', 'GET', 'Controlador_vuelos', 'mostrarTablaDeVuelos');

    $router->addRoute('vuelos', 'POST', 'Controlador_vuelos', 'insert_vuelo');

    $router->addRoute('TablaDeVuelo/:ID', 'PUT', 'Controlador_vuelos', 'Editar_tabla_de_vuelos');

    $router->addRoute('login', 'POST', 'loginController', 'login');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
