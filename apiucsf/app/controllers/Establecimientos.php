<?php

class Establecimientos extends MainController{

    function __construct(){

        $this->modeloEstablecimientos = $this->model('EstablecimientosModel');
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: aplication/json');
        header("Accept-application/json");

    }

    public function establecimientos_get($tipo = null, $pagina = 1, $pos_pagina = 5){

        $cuantos = $this->modeloEstablecimientos->getEstablecimientos($tipo);

        if($cuantos == 0){
            $respuesta = array(
                'error' => FALSE,
                'mensaje' => 'No se encontraron registros',
                'establecimientos' => []

            );
            http_response_code(200);
            echo json_encode($respuesta);
            return;
        }else{
            $respuesta  = paginar_todo($cuantos , $pagina, $pos_pagina);

            $establecimientos = $this->modeloEstablecimientos->AllEstablecimientosLimit($respuesta['desde'], $pos_pagina, $tipo);
        }
        //devuelve un arreglo "totalPaginas": 4,
        // "pagina_actual"
        // "pagina_siguiente"
        // "pagina_anterior"
        // "desde" ====> que seria el limite de registro o hasta donde 
        //  traera los registros 
        
        if ($establecimientos) {
            $respuesta = array(
                'error' => FALSE,
                'mensaje' => 'Datos cargados correctamente, Pag: '.$respuesta['pagina_actual'].'/'.$respuesta['totalPaginas'],
                'paginaActual' => $respuesta['pagina_actual'],
                'totalPaginas' => $respuesta['totalPaginas'],
                'totalRegistros' => $respuesta['cuantos'],
                'establecimientos' => $establecimientos

            );
            http_response_code(200);
            echo json_encode($respuesta);
            return;
        }else{
            $respuesta = array(

                'error' => TRUE,
                'mensaje' => 'Ha ocurrido un error',
                'establecimientos' => ''

            );
            http_response_code(405);
            echo json_encode($respuesta);
            return;
        }
        //eliminando un campo de la respuesta
        // unset($respuesta['desde']);
        // $respuesta['establecimientos'] = $establecimientos;

    }

    public function establecimientos_search($tipo = null, $busqueda = null){

        
        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
        //     $busqueda =  $_SERVER['HTTP_BUSQUEDA'];
        //     $tipo =  $_SERVER['HTTP_TIPO'];

        // }
        
        
        $registros = $this->modeloEstablecimientos->searchEstablecimientos($tipo, $busqueda);

        $establecimientos = $registros[1];
        $numEstablecimientos = $registros[0];

        if ($establecimientos AND $numEstablecimientos >= 1) {
            
            $respuesta = array(
                'error' => false,
                'mensaje' => "Registros cargados $numEstablecimientos",
                'establecimientos' => $establecimientos
            );

            http_response_code(200);
            echo json_encode($respuesta);
            return;

        }else{
            $respuesta = array(

                'error' => false,
                'mensaje' => "No hay resultados para $busqueda",
                'establecimientos' => []

            );
            http_response_code(200);
            echo json_encode($respuesta);
            return;
        }

        

    }
}


?>
