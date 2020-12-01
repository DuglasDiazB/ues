<?php

class Inspecciones extends MainController{

    function __construct(){

        $this->modeloEstablecimientos = $this->model('EstablecimientosModel');
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: aplication/json');
        header("Accept-application/json");

    }
    //Metodo para realizar inspeccion
    public function realizrInspec(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //obteniendo el establecimiento
            $establecimiento = $this->modeloEstablecimientos->getEstablecimiento($_POST['idEstab']);
            
            //verificando si el establecimiento existe
            if (count($establecimiento) > 0) {

                //guardando el id
                $idEstab = $establecimiento[0]->id_estab;
                
                $establecimiento = $establecimiento[0];
                //guardando inspeccion para 
                $inspecPara = $_POST['inspecPara'];
                //guardando objeto de visita
                $objetoVisita = $_POST['objetoVisita'];
                //guardando nombre del inspector
                $nombreInspec = $_POST['nombreInspector'];
                //guardando Nota obtenida
                $puntuacion = $_POST['calPrimerInspec'];
                //obteniendo inspeccion
                $inspeccion = $this->modeloEstablecimientos->getInspecciones($idEstab);
                
                //obtenemos la fecha actual 
                $fechaActual = $this->modeloEstablecimientos->getfechaActual()->hoy;
                 

                //verificando si existe alguna inspeccion
                if (count($inspeccion) > 0) {

                    $inspeccion = $inspeccion[0];
                    
                    //primera inspeccion y verificando si en la ultima inspeccion logro 90 puntos
                    if((($inspeccion->fecha_inspec == NULL AND $inspeccion->cal_primer_inspec == NULL)
                        AND ($inspeccion->primer_reinspec_fecha == NULL AND $inspeccion->primer_reinspec_cal == NULL)
                        AND ($inspeccion->segunda_reinspec_fecha == NULL AND $inspeccion->segunda_reinspec_cal == NULL))
                        OR ($inspeccion->segunda_reinspec_cal != NULL AND $inspeccion->segunda_reinspec_cal >= 90)){

                        //hacemos un insert de la primera registro en la tabla inspecciones
                        if($this->modeloEstablecimientos->updateInspeccion($inspeccion->id_inspec, $inspecPara, $fechaActual, $objetoVisita,
                                                                            $nombreInspec, $puntuacion, NULL, NULL, NULL, NULL, $idEstab)){

                            $error = false;
                            $mensaje = 'Se guardo correctamente';

                        }else{
                            $error = TRUE;
                            $mensaje = 'No es posible guardar';
                        } 
                    }elseif (($inspeccion->fecha_inspec != NULL AND $inspeccion->cal_primer_inspec != NULL)
                        AND ($inspeccion->primer_reinspec_fecha == NULL AND $inspeccion->primer_reinspec_cal == NULL)
                        AND ($inspeccion->segunda_reinspec_fecha == NULL AND $inspeccion->segunda_reinspec_cal == NULL)) {
                        
                        //verificamos si en la primera inspeccion obtuvo el puntaje requerido
                        if ($inspeccion->cal_primer_inspec >= 90) {
                            //hacemos un insert del registro en la tabla inspecciones
                            if($this->modeloEstablecimientos->updateInspeccion($inspeccion->id_inspec, $inspecPara, $fechaActual, $objetoVisita,
                                $nombreInspec, $puntuacion, NULL, NULL, NULL, NULL, $idEstab)){

                                $error = false;
                                $mensaje = 'Se guardo correctamente';

                            }else{
                                $error = TRUE;
                                $mensaje = 'No es posible guardar';
                            } 
                        }else{
                            if($this->modeloEstablecimientos->updateInspeccion($inspeccion->id_inspec, $inspeccion->inspec_para, $inspeccion->fecha_inspec, $inspeccion->objeto_visita,
                                $nombreInspec, $inspeccion->cal_primer_inspec, $fechaActual, $puntuacion, NULL, NULL, $idEstab)){

                                $error = false;
                                $mensaje = 'Se guardo correctamente';

                            }else{
                                $error = TRUE;
                                $mensaje = 'No es posible guardar';
                            } 
                            
                        }
                    }elseif (($inspeccion->fecha_inspec != NULL AND $inspeccion->cal_primer_inspec != NULL)
                        AND ($inspeccion->primer_reinspec_fecha != NULL AND $inspeccion->primer_reinspec_cal != NULL)
                        AND ($inspeccion->segunda_reinspec_fecha == NULL AND $inspeccion->segunda_reinspec_cal == NULL)) {
                            

                            //verificamos si la segunda nota es 90 
                            if ($inspeccion->primer_reinspec_cal >= 90) {

                                //guardamos esta como la primera nota si la nueva puntuacion supera 90
                                                             
                                if($this->modeloEstablecimientos->updateInspeccion($inspeccion->id_inspec, $inspecPara, $fechaActual, $objetoVisita,
                                                                                $nombreInspec, $puntuacion, NULL, NULL, NULL, NULL, $idEstab)){
    
                                    $error = false;
                                    $mensaje = 'Se guardo correctamente';
    
                                }else{
                                    $error = TRUE;
                                    $mensaje = 'No es posible guardar';
                                }
                                //guardamos la tercera nota
                                

                            // sino verificamos si la segunda nota < 90 tercera nota llego a 90 o mas
                            // guardamos la nota como la tercera   
                            }elseif ($inspeccion->primer_reinspec_cal <= 90) {
                                                                

                            if($this->modeloEstablecimientos->updateInspeccion($inspeccion->id_inspec, $inspecPara, $fechaActual, $objetoVisita,
                                $nombreInspec, $inspeccion->cal_primer_inspec, $inspeccion->primer_reinspec_fecha,  $inspeccion->primer_reinspec_cal, $fechaActual, $puntuacion, $idEstab)){
    
                                $error = false;
                                $mensaje = 'Se guardo correctamente';
    
                            }else{
                                $error = TRUE;
                                $mensaje = 'No es posible guardar';
                            }

                            if ($puntuacion < 90) {

                                $error = false;
                                $mensaje = 'El establecimiento fue dasactivado, ya que este es su ultimo intento';
                                        
                                $this->modeloEstablecimientos->desacEstab($establecimiento);
                            }
                                
                        }

                                                    
                    }elseif ($inspeccion->segunda_reinspec_fecha != NULL AND $inspeccion->segunda_reinspec_cal != NULL) {
                        
                        if($this->modeloEstablecimientos->updateInspeccion($inspeccion->id_inspec, $inspecPara, $fechaActual, $objetoVisita,
                            $nombreInspec, $inspeccion->cal_primer_inspec, $inspeccion->primer_reinspec_fecha,  $inspeccion->primer_reinspec_cal, $fechaActual, $puntuacion, $idEstab)){

                            $error = false;
                            $mensaje = 'Se guardo correctamente';

                        }else{
                            $error = TRUE;
                            $mensaje = 'No es posible guardar';
                        }

                        if ($puntuacion < 90) {

                            $error = false;
                            $mensaje = 'El establecimiento fue dasactivado, ya que este es su ultimo intento';
                                    
                            $this->modeloEstablecimientos->desacEstab($establecimiento);
                        }
                        
                    }
                //no se le ha realizado ninguna inspeccion anteriormente
                }else{

                    //hacemos un insert del registro en la tabla inspecciones
                    if($this->modeloEstablecimientos->saveInspeccion($_POST, $inspecAnterior)){
                        $error = false;
                        $mensaje = 'Se guardo correctamente';
                    }else{
                        $error = TRUE;
                        $mensaje = 'No es posible guardar';
                    }                    
                }

                
                //el establecimiento no existe
            } else {
                
                $error = TRUE;
                $mensaje = 'El establecimiento no existe';
            }
            
            
            $respuesta = array(
                'error' => $error,
                'mensaje' => $mensaje,    
            );

            http_response_code(200);
            echo json_encode($respuesta);
            return;
            

            
            // //1.0 Verificando si el establecimiento existe
            // if ($this->modeloEstablecimientos->getEstablecimientoNum($_POST['idEstab'])) {
                
                
            //     //2.0 necesitamos saber si no se a inspeccionado el establecimiento
            //     //buscando en la tabla inspecciones el id del establecimiento 
            //     //si encuentra 0 registros significa que no se le ha hecho inspeccion
            //     if($this->modeloEstablecimientos->getInspecEstablecimiento($_POST['idEstab']) == 0){


            //         //2.1 Al no existir creamos ese registro
            //         if($this->modeloEstablecimientos->InsertNuevaInspec($_POST)){

            //             $respuesta = array(
            //                 'error' => FALSE,
            //                 'mensaje' => 'Se ha realizado el registro',
            //             );
            //             http_response_code(200);
            //             echo json_encode($respuesta);
            //             return;

            //         //2.1 Si no se logra hacer el registro error   
            //         }else{

            //             $respuesta = array(
            //                 'error' => TRUE,
            //                 'mensaje' => 'No es posible hacer el registro',
            //             );
            //             http_response_code(405);
            //             echo json_encode($respuesta);
            //             return;
            //         }

            //         //que haremos si ya se hizo la primera inspeccion es decir si encuentra 
            //         // el registro del establecimiento en la tabla inspecciones
            //     }else{
                    
                    
            //         //optendreamos la inspeccion anterior a traves del id del establecimiento
            //         //enviado en el formulario
            //         $inspecAnterior = $this->modeloEstablecimientos->puntuacionesInspec($_POST['idEstab']);
                    
            //         //verificando si en la primera inspeccion no obtuvo el puntaje de 100 requeridos
            //         if ($inspecAnterior->cal_primer_inspec < 90 && $inspecAnterior->primer_reinspec_cal == NULL && $inspecAnterior->segunda_reinspec_cal  == NULL && $_POST['calPrimerInspec'] <= 90) {
                        
            //             //ahora creamos la segunda inspeccion manteniendo los resultados de la
            //             //inspeccion anterior
            //             if($this->modeloEstablecimientos->segundaInspec($_POST, $inspecAnterior)){
            //                 $respuesta = array(
            //                     'error' => false,
            //                     'mensaje' => 'Registro correcto',
                                
            //                 );
            //                 http_response_code(200);
            //                 echo json_encode($respuesta);
            //                 return;
            //                 //en el caso deque no se pueda realizar el registro mandamos un mensaje de error
            //             }else{
            //                 $respuesta = array(
            //                     'error' => TRUE,
            //                     'mensaje' => 'No se pudo relaizar la peticion',
            //                 );
            //                 http_response_code(200);
            //                 echo json_encode($respuesta);
            //                 return;
            //             }
                    
            //         // Verificamos que la segunda inspeccion este llena para poder llenar la tercera
            //         }else if($inspecAnterior->cal_primer_inspec < 90 && $inspecAnterior->primer_reinspec_cal != null && $inspecAnterior->segunda_reinspec_cal == null && $_POST['calPrimerInspec'] <= 90){
                        
            //             //se crea la tercera inspeccion
            //             if($this->modeloEstablecimientos->TerceraInspec($_POST, $inspecAnterior) && $inspecAnterior->primer_reinspec_cal < 90){
                            
            //                 //verificamos que la tercera puntuacion sea la requerida si no es asi
            //                 //desactivamos el restaurante
            //                 if ($_POST['calPrimerInspec'] < 90) {
                                
            //                     $estab = $this->modeloEstablecimientos->obtenerEstab($_POST['idEstab']);
            //                     $this->modeloEstablecimientos->desacEstab($estab);
            //                     $respuesta = array(
            //                         'error' => false,
            //                         'mensaje' => 'Alcanzo el maximo 3 de oportunidades',
                                    
            //                     );
            //                 }else{

            //                     $respuesta = array(
            //                         'error' => false,
            //                         'mensaje' => 'Registro correcto',
                                    
            //                     );

            //                 }
                            
            //                 http_response_code(200);
            //                 echo json_encode($respuesta);
            //                 return;
            //             }else{
            //                 if($this->modeloEstablecimientos->primeraInspec($_POST, $inspecAnterior)){
            //                     $respuesta = array(
            //                         'error' => false,
            //                         'mensaje' => 'Registro correcto',
                                    
            //                     );
            //                     http_response_code(200);
            //                     echo json_encode($respuesta);
            //                     return;
            //                 }
            //             }
                                           
            //         // verificando si en la primera inspeccion fue de 100
            //         }else if($inspecAnterior->cal_primer_inspec == 90 && $inspecAnterior->primer_reinspec_cal == null && $inspecAnterior->segunda_reinspec_cal == null && $_POST['calPrimerInspec'] <= 90){
                        
            //             //hacemos que la primera inspeccion sea la puntuacion nueva
            //             if ($_POST['calPrimerInspec'] <= 90) {
            //                 if($this->modeloEstablecimientos->primeraInspec($_POST, $inspecAnterior)){
            //                     $respuesta = array(
            //                         'error' => false,
            //                         'mensaje' => 'Registro correcto',
                                    
            //                     );
            //                     http_response_code(200);
            //                     echo json_encode($respuesta);
            //                     return;
            //                 }
            //             }
                    
            //             // verificando si en la tercera puntuacion obtenida logro llegar al 100
            //         }else if($inspecAnterior->cal_primer_inspec < 90 && $inspecAnterior->primer_reinspec_cal < 90 && $inspecAnterior->segunda_reinspec_cal == 90){
                        
            //             //reiniciamos las puntuaciones y colocamos la puntuacion obtenida como la primera 
            //             if($this->modeloEstablecimientos->primeraInspec($_POST, $inspecAnterior)){
            //                 $respuesta = array(
            //                     'error' => false,
            //                     'mensaje' => 'Registro correcto',
                                
            //                 );
            //                 http_response_code(200);
            //                 echo json_encode($respuesta);
            //                 return;
            //             }
            //             //verificamos si en todas las puntuaciones no se ha logrado el 100
            //         }else if($inspecAnterior->cal_primer_inspec < 90 && $inspecAnterior->primer_reinspec_cal < 90 && $inspecAnterior->segunda_reinspec_cal < 90){

                        
            //             //si la nueva puntuacion no logra el 100
            //             if($_POST['calPrimerInspec'] < 90){

            //                 //la guardamos en la tercera puntuacion
            //                 if($this->modeloEstablecimientos->TerceraInspec($_POST, $inspecAnterior)){
            //                     $respuesta = array(
            //                         'error' => false,
            //                         'mensaje' => 'Registro correcto',
                                    
            //                     );
                                
            //                     // Al no haber llegado a la puntuacion en las tres oportunidades.
            //                     //desactivamos el restaurante
            //                     //-------------------------------------------------------
            //                     $estab = $this->modeloEstablecimientos->obtenerEstab($_POST['idEstab']);
            //                     $this->modeloEstablecimientos->desacEstab($estab);
            //                     //-------------------------------------------------------
            //                     http_response_code(200);
            //                     echo json_encode($respuesta);
            //                     return;
            //                 }

            //             //en el caso de que lograra llegar al 100    
            //             }else{
                            
            //                 //guardamos la puntuacion como la primera
            //                 if($this->modeloEstablecimientos->primeraInspec($_POST, $inspecAnterior)){
            //                     $respuesta = array(
            //                         'error' => false,
            //                         'mensaje' => 'Registro correcto',
                                    
            //                     );
            //                     http_response_code(200);
            //                     echo json_encode($respuesta);
            //                     return;
            //                 }

            //             }

            //         }
            //     }
            // }else{
            //     $respuesta = array(
            //         'error' => TRUE,
            //         'mensaje' => 'El establecimiento no existe',                    
            //     );
            //     http_response_code(200);
            //     echo json_encode($respuesta);
            //     return;
            // }
        }

    }

    //funcion para obtener informacion de las inspecciones realizadas
    public function getInspec($id){


        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            //1.0 necesitamos saber que existe la inspeccion a traves del idEstab
            if ($this->modeloEstablecimientos->getInspecEstablecimientoNum($id) > 0) {
    
                

                $inspec = $this->modeloEstablecimientos->getInspecciones($id);
                

                foreach ($inspec as $nombre_campo => $valor_campo) {
                    
                    if ($valor_campo == null) {
                        $inspec->$nombre_campo = '---';
                    }
                }
                
                $respuesta = array(
                    'error' => FALSE,
                    'mensaje' => 'Datos cargados correctamente',
                    'inspeccion' => $inspec
                );
                http_response_code(200);
                echo json_encode($respuesta);
                return;

            }else{

                //si no existe el registro
                $respuesta = array(
                    'error' => FALSE,
                    'mensaje' => 'No se encontraron datos de inspeccion',
                    'inspeccion' => []
                );
                http_response_code(200);
                echo json_encode($respuesta);
                return;
    
            }
        }

        
    }

    //funcion para obtener el total de manipuladores, total hombres y total mujeres
    public function get_manipuladores($idEstablecimiento){

        //trae el total de manipuladores, total hombres y total mujeres
        $manipuladores = $this->modeloEstablecimientos->getManipuladores($idEstablecimiento);

        //verificamos que se haya encontrado manipuladores con el [total]

        if ($manipuladores['total'] == 0) {

            $respuesta = array(
                'error' => FALSE,
                'mensaje' => 'No se encontraron registros',
                'manipuladores' => $manipuladores

            );
            http_response_code(200);
            echo json_encode($respuesta);
            return;
        }else{

            $respuesta = array(
                'error' => FALSE,
                'mensaje' => 'Datos cargados correctamente',
                'manipuladores' => $manipuladores
            );
            http_response_code(200);
            echo json_encode($respuesta);
            return;
        }

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
