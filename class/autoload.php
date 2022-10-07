<?php 

// Charge automatiquement les classes à utiliser
spl_autoload_register (function ($className) {
    $className = str_replace("\\", "/", $className);
    require_once("class/$className.php");
});