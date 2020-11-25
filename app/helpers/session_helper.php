<?php
//para verificar que inicio sesion un administrador
    function sessionAdmin(){
        //iniciamos una sesion
        session_start();
        //hacer la verificion que se inicio la sesion  y que sea el tipo de usuario correcto
        if (!isset($_SESSION['user']) || $_SESSION['user']->idtipousuario == 2) {
            //redireccionar al usuario
            header('location:'.ROUTE_URL);
        }

    }

    //para verificar que es un usuario normal

    function sessionUser(){

        session_start();
        if (!isset($_SESSION['user'])) {
            header('location:'.ROUTE_URL.'/login');
        }
    }




?>