<?php
    // require_once("library/Core.php");
    // require_once("library/MainController.php");
    // require_once("library/Sql.php");

    //Cargamos las librerias
    require_once('config/config.php');
    require_once('helpers/utilidades_helper.php');
    require_once('helpers/paginacion_helper.php');
    

    //Cargamos todos los archivos de la carpeta library
    spl_autoload_register(function($className){
        require_once('library/' . $className .'.php');
    });
    

?>