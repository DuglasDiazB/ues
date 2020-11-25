<?php 
    class Examenes extends MainController{

        public function __construct(){
            sessionAdmin();
            $this->modeloExamenes = $this->model('ModeloExamenes');
            $this->ModeloCredenciales = $this->model('ModeloCredenciales');
        }

        public function verExamen($id, $pagina, $busqueda = null){

            $examen = $this->modeloExamenes->obtenerExamen($id);

            //ruta para regresar al estado anterior del index
            if ($examen->estado_exam == 'Acto') {
                
                $regresar = ROUTE_URL.'/examenes/index/' . $pagina . '/' . $busqueda;
            } else {
                $regresar = ROUTE_URL.'/examenes/examenesNoActos/' . $pagina . '/' . $busqueda;
            }

            $parameters = [
                'title'   => 'Ver Examen',
                'mensaje' =>  'No se admite editar examen',
                'menu'    => 'examenes',
                'title'   => 'Examen',
                'regresar' => $regresar,
                'examen'   =>$examen
            ];

            $this->view('examenes/ver_examen', $parameters);
        }

        public function index($pagina = 1, $busqueda = null, $postPagina = 10){
            
            
            
            $rutaBusqueda = ROUTE_URL.'/examenes/index'; 
            $examenes = null;
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;
                
            }elseif ($busqueda != '') {
                
                $busqueda = strtolower(str_replace('_', ' ',$busqueda));
                
            }
            
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
            $cuantosRegistros = $this->modeloExamenes->numeroRegistros($busqueda);
            
            $respuesta = paginar_todo($cuantosRegistros, $pagina, $postPagina);
            
            if (!$respuesta['error']) {
                                
                $examenes = $this->modeloExamenes->examenesPorLimite($postPagina, $respuesta['desde'], $busqueda);
                                    
            }
            
            $parameters = [
                'menu' => 'examenes',
                'title' => 'Examenes',
                'respuesta' => $respuesta,
                'examenes' => $examenes,
                'busqueda' => $busqueda,
                'rutaContrBusqueda' => $rutaBusqueda
            ];

            $this->view('examenes/index', $parameters);
        }

        public function examenesNoActos($pagina = 1, $busqueda = null, $postPagina = 10){

            $rutaBusqueda = ROUTE_URL.'/examenes/examenesNoActos'; 
            $examenes = null;
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;
                
            }elseif ($busqueda != '') {
                
                $busqueda = strtolower(str_replace('_', ' ',$busqueda));
                
            }

            $cuantosRegistros = $this->modeloExamenes->numeroRegistros($busqueda, 'No acto');
            
            $respuesta = paginar_todo($cuantosRegistros, $pagina, $postPagina);
            
            if (!$respuesta['error']) {
                                
                $examenes = $this->modeloExamenes->examenesPorLimite($postPagina, $respuesta['desde'], $busqueda, 'No acto');
                
            }
            
            $parameters = [
                'menu' => 'examenes',
                'title' => 'Examenes No aptos',
                'respuesta' => $respuesta,
                'examenes' => $examenes,
                'busqueda' => $busqueda,
                'rutaContrBusqueda' => $rutaBusqueda
            ];

            $this->view('examenes/examenesNoActos', $parameters);
        }

        public function actualizarExamen($id = 0, $pagina = 1, $busqueda = null){

            $error = FALSE;
            $regresar = ROUTE_URL.'/examenes/examenesNoActos/' . $pagina . '/' . $busqueda;
            //Comprobamos que exista el registro
            if (!$this->modeloExamenes->obtenerExamen($id) && $_SERVER['REQUEST_METHOD'] == 'GET') {
                
                $parameters = [
                    'error' => TRUE,
                    'mensaje' => 'El registro no existe',
                    'errores' => [],
                    'menu' => 'examenes',
                    'title' => 'Actualizar Examenes'
                ];
                
                $this->view('examenes/actualizar_examen', $parameters);
            }
           

            //se han enviado datos
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $regresar = ROUTE_URL.'/examenes/examenesNoActos/' . $_POST['pagina'] . '/' . $_POST['busqueda'];
                
                //obteniendo los registros anteriores respecto al id 
                $examen = $this->modeloExamenes->obtenerExamen($_POST['id']);

                //obteniendo el id del manipulador de alimentos
                $examen->id_manip = $_POST['id_manip'];
                //comprobando si existen cambios al registro anterior y sustituyendo para SO y SO2
                $examen->fecha_entrega_so = ($_POST['fecha_entrega_so'] != $examen->fecha_entrega_so) ? $_POST['fecha_entrega_so'] : $examen->fecha_entrega_so;
                $examen->exam_s = ($_POST['exam_s'] != $examen->exam_s) ? $_POST['exam_s'] : $examen->exam_s;
                $examen->exam_o = ($_POST['exam_o'] != $examen->exam_o) ? $_POST['exam_o'] : $examen->exam_o;

                $examen->exam_s2 = ($_POST['exam_s2'] != $examen->exam_s2) ? $_POST['exam_s2'] : $examen->exam_s2;
                $examen->exam_o2 = ($_POST['exam_o2'] != $examen->exam_o2) ? $_POST['exam_o2'] : $examen->exam_o2;
                
                //obteniendo el nombre de usuario que esta efectuando el update
                $examen->usermod = $_SESSION['user']->username;
                
                //comprobando si aprueba el 
                if (($examen->exam_s == 'No entregado' && $examen->exam_o == 'No entregado')){
                                        
                    $examen->fecha_entrega_so = NULL;
                    
                }
               
                if (($examen->exam_s == 'DN' && $examen->exam_o == 'DN')){
                    
                    $examen->estado_exam = 'Acto';
                    $examen->exam_s2 = 'No entregado';
                    $examen->exam_o2 = 'No entregado';
                    $examen->fecha_exped_exam = $this->modeloExamenes->sumarMeses(6)->expedicion;
                    $examen->fecha_entrega_so2 = NULL;
                    
                }else {
                    $examen->fecha_entrega_so2 = $_POST['fecha_entrega_so2'];
                }
                
                if (($examen->exam_s2 == 'DN' && $examen->exam_o2 == 'DN')) {
                    $examen->fecha_exped_exam = $this->modeloExamenes->sumarMeses(6)->expedicion;
                    $examen->estado_exam = 'Acto';
                    $examen->fecha_entrega_so2 = ($_POST['fecha_entrega_so2'] != $examen->fecha_entrega_so2) ? $_POST['fecha_entrega_so2'] : $examen->fecha_entrega_so2;
                    
                }

                if (($examen->exam_s2 == 'No entregado' && $examen->exam_o2 == 'No entregado')){
                                        
                    $examen->fecha_entrega_so2 = NULL;
                    
                }
                                               
                $errores['id']['text'] = $examen->id_exam;
                $errores['id_manip']['text'] = $examen->id_manip;
                $errores['dui_manip']['text'] = $examen->dui_manip;
                $errores['nombre_manip']['text'] = $examen->nombre_manip;
                $errores['apellido_manip']['text'] = $examen->apellido_manip;
                $errores['puesto_manip']['text'] = $examen->puesto_manip;
                $errores['nombre_estab']['text'] = $examen->nombre_estab;
                $errores['direccion_estab']['text'] = $examen->direccion_estab; 
                $errores['estado_exam']['text'] = $examen->estado_exam;  
                $errores['fecha_entrega_so']  = $examen->fecha_entrega_so;
                $errores['exam_s'] = $examen->exam_s;
                $errores['exam_o'] = $examen->exam_o;                
                $errores['fecha_entrega_so2'] = $examen->fecha_entrega_so2;                
                $errores['exam_s2'] = $examen->exam_s2;
                $errores['exam_o2'] = $examen->exam_o2; 

                $asistencia = $this->modeloExamenes->obtenerAsistencia($examen->id_manip);
                    //verificando si esta acto para recibir la credencial\
                    
                $credencial = $this->modeloExamenes->obtenerCredencial($examen->id_manip);
                
                           
                //actualizando usuario

                if ($this->modeloExamenes->examenesUpdate($examen)) {

                    
                    $asistencia = $this->modeloExamenes->obtenerAsistencia2($examen->id_exam);
                 
                    //verificando si esta acto para recibir la credencial\                    
                    $credencial = $this->modeloExamenes->obtenerCredencial($examen->id_manip);

                    if($asistencia->asistencia == 'Si' AND $examen->estado_exam == 'Acto'){

                        $hoy = $this->ModeloCredenciales->obtenerFechaActual()->hoy;
                        $expiracion =  $this->ModeloCredenciales->sumarYear()->expedicion;

                        $this->ModeloCredenciales->actualizarCredencial($credencial->id_creden, $examen->id_manip, $expiracion, 'Activo', $hoy);

                    }else{

                        $this->ModeloCredenciales->actualizarCredencial($credencial->id_creden, $credencial->id_manip, NULL, 'Inactivo', NULL);

                    }
                    
                                        
                    $parameters = [
                        
                        'regresar' => $regresar,
						'title' => 'Actualizar Examenes',
						'menu' => 'examenes',
						'mensaje' => 'Se actualizo el registro correctamente',						
						'errores' => $errores,						
	
                    ];
                    
                    $this->view('examenes/actualizar_examen', $parameters);
                    
                }
                
            }else{

                $examen = $this->modeloExamenes->obtenerExamen($id);
                
                $errores['id']['text'] = $examen->id_exam;
                $errores['id_manip']['text'] = $examen->id_manip;
                $errores['dui_manip']['text'] = $examen->dui_manip;
                $errores['nombre_manip']['text'] = $examen->nombre_manip;
                $errores['apellido_manip']['text'] = $examen->apellido_manip;
                $errores['puesto_manip']['text'] = $examen->puesto_manip;
                $errores['nombre_estab']['text'] = $examen->nombre_estab;
                $errores['direccion_estab']['text'] = $examen->direccion_estab; 
                $errores['estado_exam']['text'] = $examen->estado_exam;  
                $errores['fecha_entrega_so']  = ($examen->fecha_entrega_so != 'sin fecha') ?
                                                 $examen->fecha_entrega_so:
                                                 $this->modeloExamenes->obtenerFechaActual()->hoy;
                $errores['exam_s'] = $examen->exam_s;
                $errores['exam_o'] = $examen->exam_o;
                
                if(($examen->exam_o != 'No entregado' && $examen->exam_o != 'DN') || ($examen->exam_s != 'No entregado' && $examen->exam_s != 'DN')){
    
                    $errores['fecha_entrega_so2']  = $this->modeloExamenes->obtenerFechaActual()->hoy;
                }else{
    
                    $errores['fecha_entrega_so2'] = $examen->fecha_entrega_so2;
                }
                $errores['exam_s2'] = $examen->exam_s2;
                $errores['exam_o2'] = $examen->exam_o2;  
    
                $parameters = [                
                    'errores' => $errores,
                    'regresar' => $regresar,
                    'pagina' => $pagina,
                    'busqueda' => $busqueda,                
                    'menu' => 'examenes',
                    'title' => 'Actualizar Examenes',
                    'mensaje' => 'Puede editar fecha de entrega SO, examenes de S y O',
                ];
                                               
                $this->view('examenes/actualizar_examen', $parameters);
            }
                    
        }
    }

?>