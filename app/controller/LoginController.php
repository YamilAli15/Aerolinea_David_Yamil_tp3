<?php

require_once "app/view/AvionesView.php";
require_once "app/model/Usuarios.php";


class login
{

    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new datos_de_usuarios();
        $this->view = new AvionesView();
    }
    function Homepage()
    {
        $this->view->Homepage();
    }
    function login()
    {
        $this->view->login();
    }

    function logout()
    {
        session_start();
        session_destroy();
        header("Location:" . BASE_URL . "login");
    }

    function Verify_login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['name']) && !empty($_POST['Password'])) {
                $name = $_POST['name'];
                $Password = $_POST['Password'];
                $users = $this->model->usuarios($name);

                if ($users && password_verify($Password, $users->Password)) {

                    session_start();
                    $_SESSION['IS_LOGGED'] = true;
                    $_SESSION['USERNAME'] = $users->name;
                    $_SESSION['ROLE'] = $users->Range;

                    header("Location:" . BASE_URL . "home");
                } else {
                    $this->view->login("Usuario incorrecto");
                }
            } else {
                $this->view->login("faltan datos obligatorios");
            }
        }
    }
}
