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
        }

        public function index($busqueda = Null){
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
  
            ];
            $this->view('index/index', $parameters);
        }
    }
?>