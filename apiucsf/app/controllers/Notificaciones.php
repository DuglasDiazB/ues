<?php

class Notificaciones extends MainController{

    public $token;

    function __construct(){

        
        $this->modeloManipuladores = $this->model('ManipuladoresModel');
        

    }

    public function prepare($token){
        $this->token = $token;
        echo $this->token;
    }
    

   

}


?>