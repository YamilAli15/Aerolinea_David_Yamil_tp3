<?php

class AuthHelpers
{

    static function checkLogged()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION["IS_LOGGED"])) {
            header("Location: " . BASE_URL . "login");
        } else {
            return true;
        }
    }

    static function isLogged()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!isset($_SESSION["IS_LOGGED"])) {
            return false;
        } else {
            return true;
        }
    }

    static function userName()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!isset($_SESSION["USERNAME"])) {
            return false;
        } else {
            return $_SESSION['USERNAME'];
        }
    }

    static function ComprobacióndeRango()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!empty($_SESSION['ROLE']) == 'Admi') {
            return true;
        } else {
            return false;
        }
    }
}
