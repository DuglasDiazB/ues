<?php
class Credenciales extends MainController
{
    public $error; 

    function __construct(){
        // para probar ponemos sesionStart aca
        sessionAdmin();
        //ModeloCredenciales es donde estan todas las consultas con la base de datos
        $this->ModeloCredenciales = $this->model('ModeloCredenciales');
        
    }
    //*********************************************************************************************************************** */
    //1-creando archivo index donde llevara la vista mostrando la tabla de credenciales
    public function index($pagina = 1, $busqueda = null, $pos_pagina = 10){
        $rutaContrBusqueda = ROUTE_URL.'/credenciales/index'; 
        $credencial = null;
        $credenciales = null;
        
       
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

        }
        
        //*********************************************************************** */
        // obteniendo todos los registros de las credenciales en estado_creden = 'Inactivo'
        $credenciales = $this->ModeloCredenciales->obtenerCredenciales();
     
        $hoy = $this->ModeloCredenciales->obtenerFechaActual()->hoy;
        
        //verificamos que existan registros
        if(count($credenciales) != 0){
            //obteniendo la fecha de expiracion de las credenciales
            $expiracion =  $this->ModeloCredenciales->sumarYear()->expedicion;

            //para cada uno de los registro verificando si
            //estado_exam = 'Acto' y asistencia = 'Si'
            //actualizando cada registro
            for ($i=0; $i <count($credenciales) ; $i++) {
                
                if ($credenciales[$i]->estado_exam == 'Acto' AND $credenciales[$i]->asistencia == 'Si') {
                    
                    //al cumplir con la normativa actualizamos la credencial a acto
                    $this->ModeloCredenciales->actualizarCredencial($credenciales[$i]->id_creden, $credenciales[$i]->id_manip, $expiracion, 'Activo', $hoy);
                    
                    //si no cumple con la normativa
                }                
                if (  $credenciales[$i]->estado_exam == 'No acto' OR $credenciales[$i]->asistencia == 'No') { 
                    $this->ModeloCredenciales->actualizarCredencial($credenciales[$i]->id_creden, $credenciales[$i]->id_manip, NULL, 'Inactivo', NULL);
                }               

            }
        }

        $cuantosRegistros = $this->ModeloCredenciales->numeroRegistros($busqueda);
        
		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);



		if (!$respuesta['error']) {
            
            $credenciales = $this->ModeloCredenciales->credencialesPorLimite($pos_pagina, $respuesta['desde'], $busqueda);
      
        }

        //Estableciendo parametros para ser llamados en la vista 
        $parameters =[
            'title'=> 'Credenciales',
            'menu' => 'credenciales',
            'rutaContrBusqueda' => $rutaContrBusqueda,
            'respuesta' => $respuesta,
            'busqueda' => $busqueda,
            'credencial' => $credencial,
            'credenciales' => $credenciales,

        ];

        //Se llama la vista que se desea mostrar en pantalla
        $this->view('credenciales/credenciales', $parameters);
    }

    //*********************************************************************************************************************** */
    //2-Mostrando opcion ver de la tabla credencial 
    public function verCredencial($id, $estadoCreden = 'Activo', $pagina, $busqueda = NULL){
        $estado_exam = str_replace('_', ' ',$estadoCreden);
        
        $credencial = $this->ModeloCredenciales->obtenerCredencial1($id, $estadoCreden);        
      
        if($credencial->estado_creden == 'Activo'){
            $regresar = ROUTE_URL.'/credenciales/index'.'/'.$pagina.'/'.$busqueda;
        }else{
            $regresar = ROUTE_URL.'/credenciales/noActos'.'/'.$pagina.'/'.$busqueda;
        }
        
		
		$parameters = [

			'title' => 'Ver Credencial',
			'error' => FALSE,
			'mensaje' => 'No se admite editar Credencial',		
			'menu' => 'Credenciales',
            'credencial' => $credencial,
            'regresar' => $regresar,
        ];
        
		$this->view('credenciales/ver_credencial', $parameters);
    }
    //*********************************************************************************************************************** */
    //3-Mostrando opcion no actos de la tabla credenciales
    public function noActos($pagina = 1, $busqueda = null, $pos_pagina = 10){
        $rutaContrBusqueda = ROUTE_URL.'/credenciales/noActos'; 
        $credencial = null;
        $credenciales = null;
        
        
        // print_r($credenciales);
        // die();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}
        
        $cuantosRegistros = $this->ModeloCredenciales->numeroRegistros($busqueda, 'Inactivo');
        
		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {
            
            $credenciales = $this->ModeloCredenciales->credencialesPorLimite($pos_pagina, $respuesta['desde'], $busqueda,'Inactivo');

        }

        //Estableciendo parametros para ser llamados en la vista 
        $parameters =[
            'title'=> 'Credenciales No Aptas',
            'menu' => 'credenciales',
            'rutaContrBusqueda' => $rutaContrBusqueda,
            'respuesta' => $respuesta,
            'busqueda' => $busqueda,
            'credencial' => $credencial,
            'credenciales' => $credenciales,

        ];

        //Se llama la vista que se desea mostrar en pantalla
        $this->view('credenciales/noActos', $parameters);
    }
    

} 