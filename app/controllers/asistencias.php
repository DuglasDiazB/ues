<?php
class Asistencias extends MainController
{
    public $error; 

    function __construct(){
        // para probar ponemos sesionStart aca
        sessionAdmin();
        //ModeloAsistencias es donde estan todas las consultas con la base de datos
        $this->ModeloAsistencias = $this->model('ModeloAsistencias');
        $this->ModeloCredenciales = $this->model('ModeloCredenciales');
        $this->ModeloBitacoras = $this->model('ModeloBitacoras');
        
    }
    //cambio 24/11/2020
	//cambio 24/11/2020
    //*********************************************************************************************************************** */
    //1-creando archivo index donde llevara la vista mostrando la tabla de asistencias
    public function index($pagina = 1, $busqueda = null, $pos_pagina = 10){
        $rutaContrBusqueda = ROUTE_URL.'/asistencias/index'; 
        $asistencia = null;
        $asistencias = null;
        
        //******************************************************************************************************/
                    //regresar las asistencias al estado inicial cuando se inician nuevas capacitaciones
                    //obtner fecha actual
        $hoy = $this->ModeloAsistencias->obtenerFechaActual()->hoy;

                    //obtener fecha de inicio y finalizacion de capacitaciones 
        $fechaCapacitaciones = $this->ModeloAsistencias->obtenerFechaCapacitaciones();
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
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

        }
                        
        $cuantosRegistros = $this->ModeloAsistencias->numeroRegistros($busqueda);
        
		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);
        
		if (!$respuesta['error']) {
            
            $asistencias = $this->ModeloAsistencias->asistenciasPorLimite($pos_pagina, $respuesta['desde'], $busqueda);
            // print_r($asistencias);
            // die();
        }

        //Estableciendo parametros para ser llamados en la vista 
        $parameters =[
            'title'=> 'Asistencia',
            'menu' => 'asistencias',
            'rutaContrBusqueda' => $rutaContrBusqueda,
            'respuesta' => $respuesta,
            'busqueda' => $busqueda,
            'asistencia' => $asistencia,
            'asistencias' => $asistencias,

        ];

        //Se llama la vista que se desea mostrar en pantalla
        $this->view('asistencias/asistencias', $parameters);
    }

     //*********************************************************************************************************************** */
	//2-Mostrando opcion ver de la tabla asistencia 
    public function verAsistencia($id, $asistencia = 'Si', $pagina, $busqueda = NULL){
        // echo $id;
        // die();
        $asistencia = $this->ModeloAsistencias->obtenerAsistencia1($id, $asistencia);
        // print_r($asistencia);
        //  die();
         $mensaje = 'Ultima modificacion ' . $asistencia->fechamodasistencia. ' por ' . $asistencia->usermod;
        if($asistencia->asistencia =='Si'){
            $regresar = ROUTE_URL.'/asistencias/index'.'/'.$pagina.'/'.$busqueda;
        }else{
            $regresar = ROUTE_URL.'/asistencias/noAsistidos'.'/'.$pagina.'/'.$busqueda;
        }
        
		
		$parameters = [

			'title' => 'Ver Asistencia',
			'error' => FALSE,
			'mensaje' =>  $mensaje ,		
			'menu' => 'asistencias',
            'asistencia' => $asistencia,
            'regresar' => $regresar,
        ];
        
		$this->view('asistencias/ver_asistencia', $parameters);
    }
    //*********************************************************************************************************************** */
	//3-Mostrando opcion ver de la tabla asistencia 
    public function fechaCapacitacion(){
        $error = FALSE;
        $pagina = NULL;
       $busqueda = NULL;
        //cuando se preciona el boton
        // ----------------- Recibiendo datos del formulario --------------------
		//Todo esto ocurren cuando se ha preccionado el boton 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $regresar = ROUTE_URL.'/asistencias/index'.'/'.$pagina.'/'.$busqueda;
            $errores['fechainiciocapacit']['text'] = $_POST['fechainiciocapacit'];
            $errores['fechafincapacit']['text'] = $_POST['fechafincapacit'];
            if ( $errores['fechainiciocapacit']['text'] == '') {
                $error = TRUE;
                $errores['fechainiciocapacit']['small'] = 'Ingrese fecha de inicio';
                $errores['fechainiciocapacit']['form-control']='error';

            }
            if ( $errores['fechafincapacit']['text'] == '') {
                $error = TRUE;
                $errores['fechafincapacit']['small'] = 'Ingrese ultima fecha de capacitacion';
                $errores['fechafincapacit']['form-control']='error';

            }

            if ($_POST['fechainiciocapacit'] == $_POST['fechafincapacit']) {
                $error = TRUE;
                $errores['fechafincapacit']['small'] = 'La fecha debe ser mayor a la de inicio';
                $errores['fechafincapacit']['form-control']='error';
                
            }

            if ($_POST['fechainiciocapacit'] > $_POST['fechafincapacit']) {
                $error = TRUE;
                $errores['fechainiciocapacit']['small'] = 'La fecha debe ser menor a la de fin';
                $errores['fechainiciocapacit']['form-control']='error';
                
            }

            if ($error == TRUE) {
                $parameters = [
                    'errores' => $errores,
                    'mensaje' => 'Verifique los campos de entrada <i style = "color:#FF0000;" class="fas fa-exclamation-circle"></i>',	
                    'title' => 'Fecha Capacitacion',
                    'menu' => 'asistencias',
                    'regresar' => $regresar,
                ];
                $this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');
                $this->view('asistencias/fechaCapacitacion', $parameters);
                
            }else{
                if ($this->ModeloAsistencias->actualizarFechaCapacitacion($errores['fechainiciocapacit']['text'], $errores['fechafincapacit']['text'],  $_SESSION['user']->username)) {

                    //******************************************************************************************************/
                    //regresar las asistencias al estado inicial cuando se inician nuevas capacitaciones

                    //obtner fecha actual
                    $hoy = $this->ModeloAsistencias->obtenerFechaActual()->hoy;

                    //obtener fecha de inicio y finalizacion de capacitaciones 
                    $fechaCapacitaciones = $this->ModeloAsistencias->obtenerFechaCapacitaciones();

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
                        
                    $parameters = [
                        'errores' => $errores,
                        'mensaje' => 'Se guardo correctamente las fechas <i style = "color: #008f39;"class="fas fa-check-circle"></i>',	
                        'title' => 'Fecha Capacitacion',
                        'menu' => 'asistencias',
                        'regresar' => $regresar,
                    ];

                    $this->ModeloBitacoras->insertBitacora($_SERVER, 'Exitosa');
                    $this->view('asistencias/fechaCapacitacion', $parameters);
                }else{

                    $parameters = [
                        'errores' => $errores,
                        'mensaje' => 'No es posible guardar en este momento <i style = "color: 	#FF0000;" class="fas fa-exclamation-circle"></i>',	
                        'title' => 'Fecha Capacitacion',
                        'menu' => 'asistencias',
                        'regresar' => $regresar,
                    ];
                    $this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');

                    $this->view('asistencias/fechaCapacitacion', $parameters);

                }
            }
    }else{
        
        $errores['fechainiciocapacit']['text'] = $this->ModeloAsistencias->obtenerFechaActual()->hoy;
        $errores['fechafincapacit']['text'] = '';
        $regresar = ROUTE_URL.'/asistencias/index'.'/'.$pagina.'/'.$busqueda;
          $parameters = [
              'errores' => $errores,
              'mensaje' => 'Ingrese el periodo de las fechas de capacitaciones',	
              'title' => 'Fecha Capacitacion',
              'menu' => 'asistencias',
              'regresar' => $regresar,
          ];
          
          $this->view('asistencias/fechaCapacitacion', $parameters);
    }
}
     //*********************************************************************************************************************** */
    //4-Mostrando opcion no asistidos de la tabla asistencia
    public function noAsistidos($pagina = 1, $busqueda = null, $pos_pagina = 10){
        $rutaContrBusqueda = ROUTE_URL.'/asistencias/noAsistidos'; 
        $asistencia = null;
        $asistencias = null;
        
        $asistencias = $this->ModeloAsistencias->obtenerAsistencias();
        // print_r($asistencias);
        // die();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}
        
        $cuantosRegistros = $this->ModeloAsistencias->numeroRegistros($busqueda, 'No');
        
		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {
            
            $asistencias = $this->ModeloAsistencias->asistenciasPorLimite($pos_pagina, $respuesta['desde'], $busqueda,'No');
        }

        //Estableciendo parametros para ser llamados en la vista 
        $parameters =[
            'title'=> 'No Asistidos',
            'menu' => 'asistencias',
            'rutaContrBusqueda' => $rutaContrBusqueda,
            'respuesta' => $respuesta,
            'busqueda' => $busqueda,
            'asistencia' => $asistencia,
            'asistencias' => $asistencias,

        ];

        //Se llama la vista que se desea mostrar en pantalla
        $this->view('asistencias/noAsistidos', $parameters);
    }

    //*********************************************************************************************************************** */
    //5-Actualizar de la tabla asistencia
    public function actualizarAsistencia($id = 0, $asistencia = 'Si', $pagina = 1, $busqueda = NULL){                             
        
        // ----------------- Recibiendo datos del formulario --------------------
		//Todo esto ocurren cuando se ha preccionado el boton 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $regresar = $_POST['regresar'];
            $asistencia = $this->ModeloAsistencias->obtenerAsistencia1($_POST['id_asistencia'], 'No');
         
            // ----------------- guardando los datos enviados por el formulario como propiedades --------------------
			$data = $this->ModeloAsistencias->set_datos($_POST);
            $errores['asistencia'] = $_POST['asistencia'];
            $errores['fechacapacitacion'] = $_POST['fechacapacitacion'];
           
            if ($this->error == TRUE) {
                $asistencia = $this->ModeloAsistencias->obtenerAsistencia1($_POST['id_asistencia'], 'No');
    
    
                $parameters = [
                    'title' => 'Editar Asistencia',
                    'error' => $this->error,
                    'mensaje' => 'Revise los campos de entrada',
                    'errores' => $errores,
                    'menu' => 'asistencias',
                    'asistencias' =>$id,
                    'asistencia' => $asistencia,
                    'regresar' => $regresar
                ];
                $this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');
    
                $this->view('asistencias/actualizar_asistencia', $parameters);
            
            }else{                
     
                if ($this->ModeloAsistencias->actualizarAsistencia($asistencia->id_asistencia , $asistencia->id_exam , $_POST['asistencia'], $_POST['fechacapacitacion'], $_SESSION['user']->username)) {

                    
                    $examen = $this->ModeloAsistencias->obtenerExamen($asistencia->id_exam);
                    
                    //verificando si esta acto para recibir la credencial\                    
                    $credencial = $this->ModeloAsistencias->obtenerCredencial($examen->id_manip);                   
               ;
                    if ($_POST['asistencia'] == 'Si') {

                        $asistencia = $this->ModeloAsistencias->obtenerAsistencia1($_POST['id_asistencia'], 'Si');
                        
                    }else{
                        $asistencia = $this->ModeloAsistencias->obtenerAsistencia1($_POST['id_asistencia'], 'No');
                    }

                    if($asistencia->asistencia == 'Si' AND $examen->estado_exam == 'Acto'){

                        $hoy = $this->ModeloCredenciales->obtenerFechaActual()->hoy;
                        $expiracion =  $this->ModeloCredenciales->sumarYear()->expedicion;

                        $this->ModeloCredenciales->actualizarCredencial($credencial->id_creden, $examen->id_manip, $expiracion, 'Activo', $hoy);

                    }else{

                        $this->ModeloCredenciales->actualizarCredencial($credencial->id_creden, $credencial->id_manip, NULL, 'Inactivo', NULL);

                    }

                    
                    $parameters = [
    
                        'error' => FALSE,
                        'mensaje' => 'Se actualizo el registro con exito <i style = "color: #008f39;"class="fas fa-check-circle"></i>',
                        'menu' => 'asistencias',
                        'title' => 'Editar Asistencia',
                        'errores' => $errores,
                        'asistencia' => $asistencia,
                        'regresar' => $regresar
                    ];

                    $this->ModeloBitacoras->insertBitacora($_SERVER, 'Exitosa');
                    $this->view('asistencias/actualizar_asistencia', $parameters);
    
                }else{
                    echo 'No se puedo actualizar el registro';
                    $this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');
                    die();
                }
    
            }
        }else{

            $asistencia = $this->ModeloAsistencias->obtenerAsistencia1($id, 'No');
            if($asistencia->asistencia =='Si'){
                $regresar = ROUTE_URL.'/asistencias/index'.'/'.$pagina.'/'.$busqueda;
            }else{
                $regresar = ROUTE_URL.'/asistencias/noAsistidos'.'/'.$pagina.'/'.$busqueda;
            }
            
            // echo $id;
            $errores['asistencia'] = $asistencia->asistencia;
            
            
            $errores['fechacapacitacion'] = $this->ModeloAsistencias->obtenerFechaActual()->hoy;
                          
            $parameters = [
    
                'title' => 'Editar Asistencia',
                'error' => FALSE,
                'mensaje' => 'Edite los campos necesarios',		
                'menu' => 'asistencias',
                'asistencia' => $asistencia,
                'errores' => $errores,
                'regresar' => $regresar,
            ];
            
            $this->view('asistencias/actualizar_asistencia', $parameters);
        }

           
    }		
		
}

	    
    

    

	    
    

    
