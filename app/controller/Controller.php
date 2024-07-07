<?php

require_once 'app/view/JSONView.php';


class Controller {

    protected $view;   
    private $data;

    public function __construct() {

        $this->view = new JSONView();
        $this->data = file_get_contents("php://input");
    }

    function getData() {
        return json_decode($this->data);
    }
}