<?php
require_once "libs/Smarty.class.php";
require_once "app/helpers/AuthHelpers.php";


class View
{
    protected $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->assign("base", BASE_URL);
        $this->smarty->assign("logeado", AuthHelpers::isLogged());
        $this->smarty->assign("usuario", AuthHelpers::userName());
        $this->smarty->assign("Rango", AuthHelpers::ComprobacióndeRango());
    }
}
