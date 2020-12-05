<?php

    // lo primero que se hace siempre es poner le nombre 

    class Index extends MainController{

        function __construct(){
            
            
        }

        function index(){

            $parameters = [
              
            ];



            $this->view('index/index', $parameters);
        }
    }
?>