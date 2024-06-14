<?php
require_once "config.php";

class Model
{ //model general 

  protected $conexion; // por herencia 

  public function __construct()
  {
    $this->conexion = $this->createConexion();
    $this->deploy();
  }

  public function createConexion()
  {

    try {
      $db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
    } catch (Exception $e) {
      var_dump($e);
    }

    return $db;
  }


  private function deploy()
  {
    $query = $this->conexion->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if (count($tables) == 0) {
      $sql = "
            
            CREATE TABLE `aerolineas_argentinas` (
                `ID` int(11) NOT NULL,
                `Aeronave` varchar(100) NOT NULL,
                `Precio` float NOT NULL,
                `Fecha` datetime NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
              
            
            
              CREATE TABLE `users` (
                `id_users` int(11) NOT NULL,
                `name` varchar(250) NOT NULL,
                `Password` varchar(250) NOT NULL,
                `Range` varchar(250) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
              

              CREATE TABLE `vuelos` (
                `ID_Vuelos` int(11) NOT NULL,
                `Destino` varchar(100) NOT NULL,
                `Pilotos` varchar(250) NOT NULL,
                `id_aerolinea` int(11) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
               

              --
              ALTER TABLE `aerolineas_argentinas`
                MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

              ALTER TABLE `users`
                MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

              ALTER TABLE `vuelos`
                MODIFY `ID_Vuelos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
                
                 
            
            ";



      $this->conexion->query($sql);
    }
  }
}
