<?php

class Login extends MainController
{
	
	public function __construct(){
		session_start();
        if (isset($_SESSION['user'])) {
            header('location:'.ROUTE_URL);
        }
        $this->modeloLogin = $this->model('modeloLogin');
        $this->modeloManipuladores = $this->model('ManipuladoresModel');
	}

	public function index(){        
        $valor1 = '';
        $valor2 = '';
        $usuario = null;
        $pass = null;
		$errores = [
            'usuario' => '',
            'pass' => '',
        ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];

        if ($usuario == '') {

            $valor1 = 'error';
            $errores['usuario'] ='Este campo es requerido';

        }else {

            $valor1 = 'success';

        }

        if ($pass == '') {

            $valor2 = 'error';
            $errores['pass'] ='Este campo es requerido';

        }else {

            $valor2 = 'success';

        }

        if ($usuario != '' && $pass != '') {
            $usuario = ucwords($usuario);
            $pass = sanitize(hash('sha512',  $pass));
            $user = $this->modeloLogin->login($usuario, $pass);
            if ($user) {
                
                $_SESSION['user'] = $user;
                
                // *********************************************preparando notificaciones************************/
                
                        //obteniendo todos los manipuladores de alimentos
                $manipuladores = $this->modeloManipuladores->getAllManipuladores();
            
                //obteniendo la fecha actual
                $fechaActual = $this->modeloManipuladores->ahora()->hoy;
                for ($i=0; $i < count($manipuladores); $i++) { 
            
                    $manipulador =  $this->modeloManipuladores->getManipulador($manipuladores[$i]->dui_manip);
                    //obtenemos la credencial del manipulador
                    $credencial = $this->modeloManipuladores->getCredencial( $manipulador->id_manip );
        
                    //obteniendo el examen correspondiente al manipulador
                    $examen = $this->modeloManipuladores->examenManipulador($manipulador->id_manip);
        
                    if($examen->fecha_exped_exam != NULL){
        
                        //restando 7 dias a la fecha de fecha_exped_exam            
                        $fechaExpedExam7 = $this->modeloManipuladores->restandoFecha($examen->fecha_exped_exam, 7)->fecha_rest;
                    }else{
                        $fechaExpedExam7 = 'sin fecha';
                    }
                    
                    //obteniendo la fecha de inicio y final de las capacitaciones
                    $fechaCapacitaciones = $this->modeloManipuladores->getFechaCapacitaciones();
                    
                    $capacitaciones = $this->modeloManipuladores->getFechaCapacSinFormato();
                    // obteniendo fecha de expiracion de examen
        
                    //obteniendo asistencias 
                    $asistencia = $this->modeloManipuladores->obtenerAsistencia1($examen->id_exam);
        
                    $fechaExpedExam = $examen->fecha_exped_exam;
                    
                    if(($examen->estado_exam == 'Acto' AND ($fechaActual >= $fechaExpedExam7  AND $fechaActual <= $fechaExpedExam)) 
                        OR ($fechaActual ==  $capacitaciones->fecha_inicio_capacit OR $fechaActual == $capacitaciones->fecha_fin_capacit)){
                            
                        //fecha expedicion                         
                        $date1 = new DateTime($fechaExpedExam);
        
                        //fecha actual 
                        $date2 = new DateTime($fechaActual);
        
                        //restando fecha expedicion - fecha actual
                        $diff = $date1->diff($date2)->days;
        
                        //verificamos si ya expiro el examen de manipulador de alimentos
                        if ($fechaActual > $fechaExpedExam) {
                        
                            $infoExamen = 'Su examen de manipulador de alimentos ya expiro, Se le exige cumplir con la normativa de entrega de exámenes';
                            
                            //desactivamos la credencial
                            $this->modeloManipuladores->desactivarCredencial($credencial);
                            
                            //pasamos a no acto los examenes
                            $this->modeloManipuladores->desactivarExamen($examen->id_exam, $examen->id_manip);
    
                            //recargamos el examen y la credencial
                            $examen = $this->modeloManipuladores->examenManipulador($manipulador->id_manip);
    
                        // 1.1 verificamos si fechaActual llego a fechaExpedExam7 = fechaExpedExam - 7 dias
                        }elseif ($fechaActual >= $fechaExpedExam7) {
        
        
                            // 1.1.1 verificamos si se ha llegado a la fecha de expedicion
                            if ($diff == 0) {
        
                                $infoExamen = 'Hoy expiran sus exámenes de manipulador de alimentos';
        
        
                            }else{
        
                                $infoExamen = 'Faltan '.$diff.' días para que su examen de manipulador de alimentos expire';
                            
                            }
                                               
                        }else{
        
                            $infoExamen = 'Faltan '.$diff.' días para que su examen de manipulador de alimentos expire';
        
                        }
        
                        //verificando cuando se entrega el primerExamen de SO
                        if ($examen->fecha_entrega_so != null && $examen->fecha_entrega_so2 == null) {
            
                            if ($examen->exam_s == 'DN') {
                                $exam_s = 'Dentro de norma';
                            }elseif($examen->exam_s == 'FN'){
                                $exam_s = 'Fuera de norma';
                            }
                            if ($examen->exam_o == 'DN') {
                                $exam_o = 'Dentro de norma';
                            }elseif($examen->exam_o == 'FN'){
                                $exam_o = 'Fuera de norma';
                            }
                                            
                        //Verificando que ya se a entregado el SO y el SO2
                        }elseif ($examen->fecha_entrega_so != null && $examen->fecha_entrega_so2 != null) {
                            
                            if ($examen->exam_s2 == 'DN') {
                                $exam_s = 'Dentro de norma';
                            }elseif($examen->exam_s2 == 'FN'){
                                $exam_s = 'Fuera de norma';
                            }
                            if ($examen->exam_o2 == 'DN') {
                                $exam_o = 'Dentro de norma';
                            }elseif($examen->exam_o2 == 'FN'){
                                $exam_o = 'Fuera de norma';
                            }                    
            
                        }              
        
                        //verificando si se ha establecido fecha para las capacitaciones                
                        if ($capacitaciones->fecha_inicio_capacit != 'No establecida' AND
                            $capacitaciones->fecha_fin_capacit != 'No establecida' AND 
                            $fechaActual <= $capacitaciones->fecha_fin_capacit) {
            
                            
                            //verificando si la fecha de hoy es igual a la fecha de capacitaciones 
                            if ($fechaActual ==  $capacitaciones->fecha_inicio_capacit) {
                                
                                $infoCapacit = 'Las capacitaciones inician este día';
        
                                if ($asistencia->fecha_asist_capacit < $capacitaciones->fecha_inicio_capacit) {
                                    
                                    $this->modeloManipuladores->actualizarAsistencia($asistencia->id_exam, $asistencia->id_asistencia);
                                    $asistencia = $this->modeloManipuladores->obtenerAsistencia1($manipulador->id_manip);
        
                                }
        
                            ////////////////////////ESTA CONDICION NO SE INCLUYE EN EL PUSHNOTIFICATION///////////////////////////
                            }elseif ( $fechaActual >  $capacitaciones->fecha_inicio_capacit AND
                                      $fechaActual < $capacitaciones->fecha_fin_capacit) {
            
                                $infoCapacit = 'Estamos en periodo de capacitaciones';
                            /////////////////////////////////////////////////////////////////////////////////////////////////////
                            }elseif ($fechaActual == $capacitaciones->fecha_fin_capacit) {
                                
                                $infoCapacit = 'Hoy finaliza el periodo de capacitaciones, por lo cual sino ha asistido se le recomienda hacer acto de presencia';
                            
                            }else{
        
                                //fecha expedicion                         
                                $date1 = new DateTime($capacitaciones->fecha_inicio_capacit);
        
                                //fecha actual 
                                $date2 = new DateTime($fechaActual);
        
                                //restando fecha expedicion - fecha actual
                                $diff = $date1->diff($date2)->days;
        
                                $infoCapacit = 'Faltan '.$diff.' días para que inicien las capacitaciones';
        
                            }
        
                            
                        }else{
                            
                            $infoCapacit = 'Ya no estamos en periodo de capacitaciones';
                            
                        } 
                                        
                        
                        $notification = [
                            "title" => "Unidad Comunitaria de Salud Familiar",
                            "body" => 'Examen: '.$infoExamen .'.  Capacitaciones: '.$infoCapacit,
                        ];
                                      
                        //obtenemos la fecha de expedicion del manipulador en formato Y-M-D
                        $fechaExpedicion = $this->modeloManipuladores->fechaExpedicion( $manipulador->id_manip );
                        
                        //Verificamos que retorna una fecha y no es null
                        //Importante los campos de la tabla tblcredenciales seran
                        //estado_creden = Inactivo, fecha_emis_creden = null, fecha_exped_creden = null  
                        
                        //fecha de ultima comprovacion de estado
                        $hoyConFormato = $this->modeloManipuladores->ahoraConformato();            
                            
            
                        if (  $examen->estado_exam == 'No acto' OR $asistencia->asistencia == 'No') { 
                           
                            //desactivamos la credencial
                            $this->modeloManipuladores->desactivarCredencial($credencial);
                        } 
            
                        $credencial = $this->modeloManipuladores->getCredencial( $manipulador->id_manip );
            
                        if($credencial->estado_creden == 'Inactivo'){
            
                            $infoCreden = 'El estado de su credencial de manipulador de alimentos es inactivo, por lo cual se le exige la asistencia a capacitaciones y entregar los exámenes clínicos correspondientes, para obtener su renovación';
            
                        }else{
            
                            $infoCreden = 'El estado de su credencial de manipulador de alimentos es activo';
                        }
            
                        $fechaExpedExam = $this->modeloManipuladores->fechaConformato($examen->fecha_exped_exam);
                        $manip = [
    
                            'estadoExam' => $examen->estado_exam,
                            'fechaExpedExam' => ($examen->fecha_exped_exam == null) ? 'Sin fecha' : $fechaExpedExam->fecha_con_formato,
                            'infoExamen' => $infoExamen, 
                            'idManip' => $manipulador->id_manip,
                            'duiManip'=> $manipulador->dui_manip,
                            'nombreManip' => $manipulador->nombre_manip,
                            'apellidoManip' => $manipulador->apellido_manip,
                            'puestoManip' => $manipulador->puesto_manip,
                            'nombreEstab' => $manipulador->nombre_estab,
                            'infoCapacit' => $infoCapacit,
                            'fechaInicioCapacit' => $fechaCapacitaciones->fecha_inicio_capacit,
                            'fechaFinCapacit' => $fechaCapacitaciones->fecha_fin_capacit,
                            'estadoCreden' => $credencial->estado_creden,
                            'asistencia' => $asistencia->asistencia,
                            // 'fechaExpedicion' => ($credencial->fecha_exped == null) ? 'sin fecha' : $credencial->fecha_exped,
                            'informacion' => $infoCreden,
                            'comprobacion' => 'Ultima comprobación '.$hoyConFormato->hoy_con_formato,
                            
                        ];          
                        prepare($manipulador->token, $notification, $manip);
                                                      
                    }
                                                     
                }  

                // **********************************************************************************************/

                
                //redireccionamos al index de la pagina
                header('location:'.ROUTE_URL.'/index');
            }else{

                $valor2 = 'error';
                $errores['pass'] ='Usuario o password incorrectos';
            }
        }

    }
    $parameters = [
        'title' => 'Login',
        'usuario' => $usuario,
        'pass' => $pass,
        'valor1' => $valor1,
        'valor2' => $valor2,
        'errores' => $errores
    ];
    $this->view('login/index', $parameters);
    }
    
    public function logout(){
        session_destroy();
        header('location:'. ROUTE_URL);        
    }
}

?>