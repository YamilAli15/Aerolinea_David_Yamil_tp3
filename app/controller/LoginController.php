<?php

require_once "app/view/AvionesView.php";
require_once "app/model/Usuarios.php";


class login
{

    private $model;
    private $view;
    private $data;

    public function __construct()
    {
        $this->model = new datos_de_usuarios();

        $this->view = new JSONView();

        $this->data = file_get_contents("php://input");
    }
   

    function logout()
    {
        session_start();
        session_destroy();
    }

    function verify_login($username, $password) {
        // Validar datos de entrada
        if (empty($username) || empty($password)) {
            return $this->view->response("Nombre de usuario y contraseña son requeridos", 400);
        }
    
        try {
            // Buscar el usuario en la base de datos
            $user = $this->model->usuarios($username);
            
            if ($user && password_verify($password, $user->Password)) {
                // Iniciar sesión de forma segura
                session_start();
                $_SESSION['IS_LOGGED'] = true;
                $_SESSION['USERNAME'] = $user->name;
                $_SESSION['ROLE'] = $user->Range;
    
                // Retornar respuesta exitosa
                return $this->view->response("Inicio de sesión exitoso", 200);
            } else {
                // Retornar respuesta de error en caso de credenciales incorrectas
                return $this->view->response("Nombre de usuario o contraseña incorrectos", 401);
            }
        } catch (Exception $e) {
            // Manejo de errores
            return $this->view->response("Error al verificar el login: " . $e->getMessage(), 500);
        }
    }
}
