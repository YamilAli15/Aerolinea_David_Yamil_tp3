<?php
require_once 'app/controller/Controller.php';
require_once 'app/model/AuthModel.php';

class loginController extends Controller{

    private $model;  

    function __construct() {
        parent::__construct();
        $this->model = new datos_de_usuarios(); 
    }
    

   







}