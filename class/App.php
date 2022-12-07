<?php


class App 
{
    /**
     * Permet le fonctionnement général de l'application
     * @return void
     */
    public static function start () 
    {
        $controllerName =   "User";
        $task           =   "auth";

        if (!empty($_GET['c']))
        {
            $controllerName = ucfirst($_GET['c']);
        }

        if (!empty($_GET['task']))
        {
            $task = $_GET['task'];
        }

        $controllerName =   "\controllers\\" . $controllerName;

        $controller     =   new $controllerName();
        $controller->$task();
    }
}