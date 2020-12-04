<?php

    // lo primero que se hace siempre es poner le nombre 

    class Index extends MainController{

        function __construct(){
            sessionUser();
            $this->modeloExamenes = $this->model('ModeloExamenes');
            $this->ModeloCredenciales = $this->model('modeloCredenciales');
            $this->ModeloAsistencias = $this->model('ModeloAsistencias');
            $this->ModeloInspecciones = $this->model('ModeloInspecciones');
            $this->ModeloUsuarios = $this->model('ModeloUsuarios');
            $this->ModeloManipuladores = $this->model('ModeloManipuladores');
            $this->ModeloEstablecimientos = $this->model('ModeloEstablecimientos');
        }

        public function index($busqueda = Null){

            //**************para comprovar que se ha llegado a la fecha de expedicion **********
            //obteniendo la fecha de hoy 
            $fechaActual = $this->modeloExamenes->obtenerFechaActual()->hoy;            
            
            //obtenemos todos los examenes que esten en estado activo
            $examenes = $this->modeloExamenes->obtenerTodosExamenes();
            
            //recorremos la lista de examenes 
            for ($i=0; $i < count($examenes); $i++) {                 
                //para cada examen vamos verificando si la fecha actual es mayor a la fecha de expedicion
                
                if ($fechaActual > $examenes[$i]->fecha_exped_exam) {
                    
                    //actualizamos los registro a examen no acto
                    $this->modeloExamenes->examenesUpdateNoActo($examenes[$i]);
                    
                }
            }
            //******************************************************************************************
            //******************************************************************************************************/
                    //regresar las asistencias al estado inicial cuando se inician nuevas capacitaciones
                    //obtner fecha actual
        $hoy =  $fechaActual;

                //obtener fecha de inicio y finalizacion de capacitaciones 
        $fechaCapacitaciones = $this->ModeloAsistencias->obtenerFechaCapacitaciones();
        if ($fechaCapacitaciones) {
            
            if($hoy >= $fechaCapacitaciones->fecha_inicio_capacit 
            AND $hoy <= $fechaCapacitaciones->fecha_fin_capacit 
            AND $fechaCapacitaciones->ejecutado == 'No'){
                        //Actualizando tblfechacapacitaciones
                $this->ModeloAsistencias->actualizarFechaCapacitacion1($fechaCapacitaciones->fecha_inicio_capacit,
                                                                        $fechaCapacitaciones->fecha_fin_capacit,
                                                                        $fechaCapacitaciones->usermod,
                                                                        $fechaCapacitaciones->fechamodcapacit);
                            //traemos todos los registros de asistencias que en la columna asistencia = 'Si'
                $asistencias = $this->ModeloAsistencias->obtenerTodasAsistencias();                        
                            // verificando de que existan registros            
                if (count($asistencias) != 0) {                                                        
                                //actualizando cada registro
                    for ($i=0; $i <count($asistencias) ; $i++) {
    
                            $manipulador = $this->ModeloAsistencias->obtenerAsistencia1($asistencias[$i]->id_asistencia);                 
                            $this->ModeloAsistencias->actualizarAsistencia($manipulador->id_asistencia, $manipulador->id_exam, 'No', NULL, NULL);                                
                    }                            
                }                        
            }
            //*********************************************************************************************** */
        }

            $examenesActos = $this->modeloExamenes->numeroRegistros($busqueda);
            $actosFormal = $this->modeloExamenes->examenesForInf('Formal', 'Acto');
            $actosInformal = $this->modeloExamenes->examenesForInf('Informal', 'Acto');

            $examenesNoactos = $this->modeloExamenes->numeroRegistros($busqueda, 'No acto');
            $noactosFormal = $this->modeloExamenes->examenesForInf('Formal', 'No acto');
            $noactosInformal = $this->modeloExamenes->examenesForInf('Informal', 'No acto');

            $credenciales = $this->ModeloCredenciales->numeroRegistros($busqueda);         
            $credencialesformal = $this->ModeloCredenciales->credencialesForInf('Formal', 'Activo');
            $credencialesinformal = $this->ModeloCredenciales->credencialesForInf('Informal', 'Activo');

            //asistencias
            $asistencias = $this->ModeloAsistencias->numeroRegistros($busqueda);
            $asistenciasFormal = $this->ModeloAsistencias->asistenciasForInf('Formal', 'Si');
            $asistenciasInformal = $this->ModeloAsistencias->asistenciasForInf('Informal', 'Si');
            //inasistencias
            $inasistencias = $this->ModeloAsistencias->numeroRegistros($busqueda, 'No');
            $inasistenciasFormal = $this->ModeloAsistencias->asistenciasForInf('Formal', 'No');
            $inasistenciasInformal = $this->ModeloAsistencias->asistenciasForInf('Informal', 'No');

            $inspecciones = $this->ModeloInspecciones->numeroRegistros($busqueda);

            $usuarios = $this->ModeloUsuarios->numeroRegistros($busqueda, '1');
            $usuarioAdmin = $this->ModeloUsuarios->tipoUsuario('1');
            $usuarioEstand = $this->ModeloUsuarios->tipoUsuario('2');
            
            $manipuladores = $this->ModeloManipuladores->numeroRegistros($busqueda);
            $manipuladoresFormal = $this->ModeloManipuladores->manipuladoresForInf('Formal', 'Activo');
            $manipuladoresInformal = $this->ModeloManipuladores->manipuladoresForInf('Informal', 'Activo');
            
            $establecimientos = $this->ModeloEstablecimientos->numeroRegistros($busqueda);
            $establecimientosFormal = $this->ModeloEstablecimientos->establecimientosForInf('Formal', 'Activo');
            $establecimientosInformal = $this->ModeloEstablecimientos->establecimientosForInf('Informal', 'Activo');

            
            $parameters = [
                'title'=> 'UCSF',
                'menu' => 'Inicio',
                'busqueda' => $busqueda,
                'examenesActos' => $examenesActos,
                'actosFormal' => $actosFormal,
                'actosInformal' => $actosInformal,
                'examenesNoactos' => $examenesNoactos,
                'noactosFormal' => $noactosFormal,
                'noactosInformal' => $noactosInformal,
                'credenciales' => $credenciales,
                'asistencias' => $asistencias,
                'inasistencias' => $inasistencias,
                'inasistenciasFormal' => $inasistenciasFormal,
                'inasistenciasInformal' => $inasistenciasInformal,
                'asistenciasFormal' => $asistenciasFormal,
                'asistenciasInformal' => $asistenciasInformal,                
                'inspecciones' => $inspecciones,
                'usuarios' => $usuarios,
                'usuarioAdmin' => $usuarioAdmin, 
                'usuarioEstand' => $usuarioEstand, 
                'credencialesformal' => $credencialesformal, 
                'credencialesinformal' => $credencialesinformal, 
                'manipuladores' => $manipuladores,
                'manipuladoresFormal' => $manipuladoresFormal,
                'manipuladoresInformal' => $manipuladoresInformal,
                'establecimientos' => $establecimientos,
                'establecimientosFormal' => $establecimientosFormal,
                'establecimientosInformal' => $establecimientosInformal,
  
            ];
            $this->view('index/index', $parameters);
        }
    }
?>