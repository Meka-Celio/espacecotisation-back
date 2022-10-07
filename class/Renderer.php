<?php


class Renderer 
{
    public static function render (string $pathfile, array $variables = []) 
    {
        extract($variables);

        ob_start();
        require('templates/' . $pathfile . '.html.php');
        $pageContent = ob_get_clean();

        require('templates/layout.html.php');
    }

    public static function formrender (string $pathfile, array $variables = [])
    {
        extract($variables);

        ob_start();
        require('templates/' . $pathfile . '.html.php');
        $pageContent = ob_get_clean();

        require('templates/form-layout.html.php');
    }
}