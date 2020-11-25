<?php
class Inspecciones extends MainController
{
    public $error; 

    function __construct(){
        // para probar ponemos sesionStart aca
        sessionAdmin();
        //ModeloInspecciones es donde estan todas las consultas con la base de datos
		$this->ModeloInspecciones = $this->model('ModeloInspecciones');
        
		$this->ModeloBitacoras = $this->model('ModeloBitacoras');
        
    }
    //*********************************************************************************************************************** */
    //1-creando archivo index donde llevara la vista mostrando la tabla de inspecciones
    public function index($pagina = 1,  $busqueda = null, $pos_pagina = 10){
        //carga la barra de busqueda
        $rutaContrBusqueda = ROUTE_URL.'/inspecciones/index'; 
        $inspeccion = null;
		$inspecciones = null;
		
		$inspecciones = $this->ModeloInspecciones->obtenerInspeccion();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}
		
		$cuantosRegistros = $this->ModeloInspecciones->numeroRegistros($busqueda);

		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {

			$inspecciones = $this->ModeloInspecciones->inspeccionesPorLimite($pos_pagina, $respuesta['desde'], $busqueda);
		}

        //Estableciendo parametros para ser llamados en la vista 
        $parameters =[
            'title'=> 'Inspecciones',
            'menu' => 'inspecciones',
            'rutaContrBusqueda' => $rutaContrBusqueda,
            'respuesta' => $respuesta,
            'busqueda' => $busqueda,
            'inspeccion' => $inspeccion,
            'inspecciones' => $inspecciones,

        ];

        //Se llama la vista que se desea mostrar en pantalla
        $this->view('inspecciones/inspecciones', $parameters);
    }

	public function establecimientosDesactivados($pagina = 1,  $busqueda = null, $pos_pagina = 10){
        //carga la barra de busqueda
        $rutaContrBusqueda = ROUTE_URL.'/inspecciones/establecimientosDesactivados'; 
        $inspeccion = null;
		$inspecciones = null;
		
		// $inspecciones = $this->ModeloInspecciones->obtenerInspeccion();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}
		
		$cuantosRegistros = $this->ModeloInspecciones->numeroRegistros($busqueda, 'Inactivo');

		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {

			$inspecciones = $this->ModeloInspecciones->inspeccionesPorLimite($pos_pagina, $respuesta['desde'], $busqueda, 'Inactivo');
		}

        //Estableciendo parametros para ser llamados en la vista 
        $parameters =[
            'title'=> 'Inspecciones Desactivadas',
            'menu' => 'inspecciones',
            'rutaContrBusqueda' => $rutaContrBusqueda,
            'respuesta' => $respuesta,
            'busqueda' => $busqueda,
            'inspeccion' => $inspeccion,
            'inspecciones' => $inspecciones,

        ];

        //Se llama la vista que se desea mostrar en pantalla
        $this->view('inspecciones/establecimientosDesactivados', $parameters);
    }
    //*********************************************************************************************************************** */
	//2-Mostrando opcion ver de la tabla inspecciones 
    public function verInspeccion($id, $pagina, $busqueda = null){

		
		$inspeccion = $this->ModeloInspecciones->obtenerInspeccion1($id);
		
		if ($inspeccion->estado_estab == 'Activo') {
			
			$regresar = ROUTE_URL.'/inspecciones/index/' . $pagina . '/' . $busqueda;
		} else {
			$regresar = ROUTE_URL.'/inspecciones/establecimientosDesactivados/' . $pagina . '/' . $busqueda;
		}
		
		if ($inspeccion->segunda_reinspec_fecha != NULL || $inspeccion->segunda_reinspec_fecha != '') {
			$mensaje = date_format(date_create($inspeccion->segunda_reinspec_fecha),"d/m/Y");
		}elseif($inspeccion->primer_reinspec_fecha != NULL || $inspeccion->primer_reinspec_fecha != ''){
			$mensaje = date_format(date_create($inspeccion->primer_reinspec_fecha),"d/m/Y");
		}elseif($inspeccion->fecha_inspec!= NULL || $inspeccion->fecha_inspec != ''){
			$mensaje = date_format(date_create($inspeccion->fecha_inspec),"d/m/Y");
		}
		
		$mensaje = 'Ultima inspeccion ' . $mensaje . ' por ' . $inspeccion->nombre_inspector;
				
		$parameters = [
			'title' => 'Ver Inspeccion',
			'error' => FALSE,
			'mensaje' => $mensaje,		
			'menu' => 'inspecciones',
			'inspeccion' => $inspeccion,
			'regresar' => $regresar
		];
		$this->view('inspecciones/ver_inspeccion', $parameters);
    }
     //*********************************************************************************************************************** */
	//3-Actualizar de la tabla inspeccion
	    
    public function actualizarInspeccion($id = NULL, $pagina = 1, $busqueda = null){
		// ----------------- Recibiendo datos del formulario --------------------
		$regresar = ROUTE_URL.'/inspecciones/index/' . $pagina . '/' . $busqueda;
		$segunda = FALSE;
		$tercera = FALSE;

		//Todo esto ocurren cuando se ha preccionado el boton 		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$regresar = ROUTE_URL.'/inspecciones/index/' . $_POST['pagina'] . '/' . $_POST['busqueda'];
			$pagina = $_POST['pagina'];
			$busqueda = $_POST['busqueda'];
			//obteniendo el registro cuando se preciona el boton el campo invisible
			$establecimiento = $this->ModeloInspecciones->obtenerEstablecimiento1($_POST['idestablecimiento']);

			$inspeccion = $this->ModeloInspecciones->obtenerInspeccion1($id);

			$inspeccion->cal_primer_inspec = (
				($inspeccion->cal_primer_inspec != NULL AND $inspeccion->cal_primer_inspec == 100)
				|| ($inspeccion->primer_reinspec_cal != NULL AND $inspeccion->primer_reinspec_cal == 100)
				|| ($inspeccion->segunda_reinspec_cal != NULL AND $inspeccion->segunda_reinspec_cal == 100)
			) ? NULL : $inspeccion->cal_primer_inspec;
			
			$inspeccion->primer_reinspec_cal = (
				($inspeccion->cal_primer_inspec != NULL AND $inspeccion->cal_primer_inspec == 100)
				|| ($inspeccion->primer_reinspec_cal != NULL AND $inspeccion->primer_reinspec_cal == 100)
				|| ($inspeccion->segunda_reinspec_cal != NULL AND $inspeccion->segunda_reinspec_cal == 100)
			) ? NULL : $inspeccion->primer_reinspec_cal;

			$inspeccion->segunda_reinspec_cal = (
				($inspeccion->cal_primer_inspec != NULL AND $inspeccion->cal_primer_inspec == 100)
				|| ($inspeccion->primer_reinspec_cal != NULL AND $inspeccion->primer_reinspec_cal == 100)
				|| ($inspeccion->segunda_reinspec_cal != NULL AND $inspeccion->segunda_reinspec_cal == 100)
			) ? NULL : $inspeccion->segunda_reinspec_cal;
			
			if ($inspeccion->cal_primer_inspec == NULL AND $inspeccion->primer_reinspec_cal == NULL AND $inspeccion->segunda_reinspec_cal == NULL 
				AND isset($_POST['notaPinspeccion']) AND !isset($_POST['pReinspecnota']) AND !isset($_POST['pResReinspecnotainspecnota'])) {
								
				$segunda = TRUE;
				$errores['fechaInspeccion'] = validafecha($_POST['fechaInspeccion']);
				$this->error = ($errores['fechaInspeccion']['form-control'] == 'error')? TRUE :$this->error;

				$errores['notaPinspeccion'] = validaNumero($_POST['notaPinspeccion']);
				$this->error = ($errores['notaPinspeccion']['form-control'] == 'error')? TRUE :$this->error;

				$errores['pReinspecfecha']['text'] = NULL;
				$errores['sReinspecfecha']['text'] = NULL;
				$errores['pReinspecnota']['text'] = NULL;
				$errores['sReinspecnota']['text'] = NULL;
							
			}

			if ($inspeccion->primer_reinspec_cal == NULL AND $inspeccion->cal_primer_inspec != NULL AND $inspeccion->segunda_reinspec_cal == NULL
				AND !isset($_POST['notaPinspeccion']) AND isset($_POST['pReinspecnota']) AND !isset($_POST['pResReinspecnotainspecnota'])){
				
				$tercera = TRUE;
				 
				$errores['fechaInspeccion']['text'] =  $inspeccion->fecha_inspec;

				$errores['notaPinspeccion']['text'] = $inspeccion->cal_primer_inspec;
				
				$errores['pReinspecfecha'] = validafecha($_POST['pReinspecfecha']);
				$this->error = ($errores['pReinspecfecha']['form-control'] == 'error')? TRUE :$this->error;

				$errores['pReinspecnota'] = validaNumero($_POST['pReinspecnota']);
				$this->error = ($errores['pReinspecnota']['form-control'] == 'error')? TRUE :$this->error;
				
				$errores['sReinspecfecha']['text'] = NULL; 
				$errores['sReinspecnota']['text'] = NULL;

			}
			if ($inspeccion->segunda_reinspec_cal == NULL AND $inspeccion->primer_reinspec_cal != NULL AND $inspeccion->cal_primer_inspec != NULL
				AND !isset($_POST['notaPinspeccion']) AND isset($_POST['pReinspecnota']) AND isset($_POST['sReinspecnota'])){
								
				$errores['fechaInspeccion']['text'] = $inspeccion->fecha_inspec; 

				$errores['notaPinspeccion']['text'] = $inspeccion->cal_primer_inspec; 
								
				$errores['pReinspecnota']['text'] = $inspeccion->primer_reinspec_cal;
				
				$errores['pReinspecfecha']['text'] = $inspeccion->primer_reinspec_fecha;
				
				$errores['sReinspecfecha'] = validafecha($_POST['sReinspecfecha']);
				$this->error = ($errores['sReinspecfecha']['form-control'] == 'error')? TRUE :$this->error;				
			
				$errores['sReinspecnota'] = validaNumero($_POST['sReinspecnota']);
				$this->error = ($errores['sReinspecnota']['form-control'] == 'error')? TRUE :$this->error;

			}
			
			// ------------------- Validando los campos del formulario ----------------------------
			
			$errores['establecimiento'] = validaNombre($_POST['establecimiento']);
			$this->error = ($errores['establecimiento']['form-control'] == 'error')? TRUE : $this->error;
	
			$errores['nombreInspector'] = validaNombre($_POST['nombreInspector']);
			$this->error = ($errores['nombreInspector']['form-control'] == 'error')? TRUE : $this->error;						
	
			$errores['inspeccionPara'] = $_POST['inspeccionPara'];
			$errores['objetoVisita'] = $_POST['objetoVisita'];
			
		if ($this->error == TRUE) {
			$inspeccion = $this->ModeloInspecciones->obtenerInspeccion1($id);


			$parameters = [
				'error' => $this->error,
				'title' => 'Actualizar Inspeccion',
				'mensaje' => 'Revise los campos de entrada',
				'errores' => $errores,
				'menu' => 'inspecciones',
				'establecimiento' => $establecimiento,
				'inspecciones' =>$id,
				'inspeccion' => $inspeccion,
				'regresar' => $regresar,
				'pagina' => $pagina,
				'busqueda' => $busqueda

			];

			$this->view('inspecciones/actualizar_inspeccion', $parameters);
		
		}else{
			
			if ((isset($_POST['sReinspecnota']) AND $_POST['sReinspecnota'] != NULL) AND $_POST['sReinspecnota'] < 100) {
				
				$this->ModeloInspecciones->actualizarEstablecimiento($establecimiento, 'Inactivo');

			}

			if ($this->ModeloInspecciones->actualizarInspeccion($_POST['idinspeccion'], $errores, $_POST['idestablecimiento'])) {
				$inspeccion = $this->ModeloInspecciones->obtenerInspeccion1($id);
		
				$parameters = [

					'error' => FALSE,
					'mensaje' => 'Se actualizo el registro con exito',
					'menu' => 'inspecciones',
					'title' => 'Editar Inspeccion',
					'errores' => $errores,
					'establecimiento' => $establecimiento,
					'inspeccion' => $inspeccion,
					'segunda' => $segunda,
					'tercera' => $tercera,
					'regresar' => $regresar,
					'pagina' => $pagina,
					'busqueda' => $busqueda
				];
				$this->view('inspecciones/actualizar_inspeccion', $parameters);

			}else{
				echo 'No se puedo actualizar el registro';
				die();
			}

		}
	}else{

		$inspeccion = $this->ModeloInspecciones->obtenerInspeccion1($id);		

		$errores['establecimiento']['text'] = $inspeccion->id_estab;
			
		$errores['nombreInspector']['text'] = $inspeccion->nombre_inspector;
		 
		if ($inspeccion->cal_primer_inspec == 100) {
			$errores['notaPinspeccion']['text'] = '';
			$errores['fechaInspeccion']['text'] = NULL;
		}else{

			$errores['fechaInspeccion']['text'] = $inspeccion->fecha_inspec;		
			
			$errores['notaPinspeccion']['text'] = $inspeccion->cal_primer_inspec;
		}

		if ($inspeccion->primer_reinspec_cal == 100) {
			$errores['notaPinspeccion']['text'] = '';
			$errores['fechaInspeccion']['text'] = NULL;
			$errores['pReinspecfecha']['text'] = '';				
			$errores['pReinspecnota']['text'] = NULL;
		}else{

			$errores['pReinspecfecha']['text'] = $inspeccion->primer_reinspec_fecha;				
			$errores['pReinspecnota']['text'] = $inspeccion->primer_reinspec_cal;
		}
		
		if ($inspeccion->segunda_reinspec_cal == 100) {
			$errores['notaPinspeccion']['text'] = '';
			$errores['fechaInspeccion']['text'] = NULL;
			$errores['pReinspecfecha']['text'] = '';				
			$errores['pReinspecnota']['text'] = NULL;
			$errores['sReinspecfecha']['text'] = '';
			$errores['sReinspecnota']['text'] = NULL;
		}else{
			
			$errores['sReinspecfecha']['text'] = $inspeccion->segunda_reinspec_fecha;								
			$errores['sReinspecnota']['text'] = $inspeccion->segunda_reinspec_cal;
		}
		
			
		$errores['inspeccionPara'] = $inspeccion->inspec_para;

		$errores['objetoVisita'] = $inspeccion->objeto_visita;
			
		$establecimiento = $this->ModeloInspecciones->obtenerEstablecimiento1($id);
				
		$parameters = [

			'error' => $this->error,
			'error' => 2,
			'errores' => $errores,
			'mensaje' => 'Edite los campos de entrada.',
			'menu' => 'inspecciones',
			'title' => 'Editar Inspeccion',
			'menu' => 'inspecciones',
			'establecimiento' => $establecimiento,
			'inspeccion' => $inspeccion,
			'inspecciones' =>$id,
			'segunda' => $segunda,
			'tercera' => $tercera,
			'regresar' => $regresar,
			'pagina' => $pagina,
			'busqueda' => $busqueda
		];
		// print_r($parameters['errores']);
		// die();
		$this->view('inspecciones/actualizar_inspeccion', $parameters);

		}	
	
	}
   
    //*********************************************************************************************************************** */
	//4-Mostrando la tabla de establecimiento de la inspeccion establecimiento
    public function inspeccionEstablecimiento($pagina = 1, $busqueda = null, $pos_pagina = 10){
        //carga la barra de busqueda
		$rutaContrBusqueda = ROUTE_URL.'/inspecciones/inspeccionEstablecimiento'; 
        $establecimiento = null;
        $establecimientos = null;

		$establecimientos = $this->ModeloInspecciones->inspeccionEstablecimientos();
		$regresar = ROUTE_URL.'/inspecciones/index/' . $pagina . '/' . $busqueda;

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}

		$cuantosRegistros = $this->ModeloInspecciones->numeroRegistrosE($busqueda);
		
		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);
		if (!$respuesta['error']) {
			
			$establecimientos = $this->ModeloInspecciones->establecimientosPorLimite($pos_pagina, $respuesta['desde'], $busqueda);
			
		}

        //Estableciendo parametros para ser llamados en la vista 
        $parameters =[
            'title'=> 'Inspeccion Establecimiento',
            'menu' => 'inspecciones',
            'rutaContrBusqueda' => $rutaContrBusqueda,
            'respuesta' => $respuesta,
            'busqueda' => $busqueda,
            'establecimiento' => $establecimiento,
			'establecimientos' => $establecimientos,
			'regresar' => $regresar

		];
		// print_r($parameters['establecimientos']);

        //Se llama la vista que se desea mostrar en pantalla
        $this->view('inspecciones/inspeccion_establecimiento', $parameters);
      
    }
    
    //*********************************************************************************************************************** */
	//5-Agregando formulario de nueva inspeccion 
	public function nuevaInspeccion($id = NULL,$pagina= NULL,$busqueda = NULL){

		// print_r($establecimiento);
		// die();
		$pagina= NULL;
		$busqueda = NULL;
		// ----------------- Recibiendo datos del formulario --------------------
		//Todo esto ocurren cuando se ha preccionado el boton 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// print_r($_POST);
			//obteniendo el registro cuando se preciona el boton el campo invisible
			$establecimiento = $this->ModeloInspecciones->obtenerEstablecimiento1($_POST['idestablecimiento']);
			$regresar = ROUTE_URL.'/inspecciones/inspeccionEstablecimiento/' . $pagina . '/' . $busqueda;
			
			// ----------------- guardando los datos enviados por el formulario como propiedades --------------------
			$data = $this->ModeloInspecciones->set_datos($_POST);
			
			// ------------------- Validando los campos del formulario ----------------------------

			$errores['establecimiento'] = validaNombre($_POST['establecimiento']);
            $this->error = ($errores['establecimiento']['form-control'] == 'error')? TRUE : $this->error;
            
            $errores['nombreInspector'] = validaNombre($_POST['nombreInspector']);
			$this->error = ($errores['nombreInspector']['form-control'] == 'error')? TRUE : $this->error;
		
			$errores['fechaInspeccion'] = validafecha($_POST['fechaInspeccion']);
			$this->error = ($errores['fechaInspeccion']['form-control'] == 'error')? TRUE :$this->error;
			
			$errores['notaPinspeccion'] = validaNumero($_POST['notaPinspeccion']);
			$this->error = ($errores['notaPinspeccion']['form-control'] == 'error')? TRUE :$this->error;
			
			$errores['pReinspecnota']['text'] = NULL;
			
            $errores['pReinspecfecha']['text'] = NULL;
			
            $errores['sReinspecfecha']['text'] = NULL;								
			
			$errores['sReinspecnota']['text'] = NULL;			
			
			$errores['inspeccionPara'] = $_POST['inspeccionPara'];
			$errores['objetoVisita'] = $_POST['objetoVisita'];	
						
			if ($this->error == TRUE) {

				$parameters = [
					'error' => $this->error,
					'mensaje' => 'Revise los campos de entrada',
					'errores' => $errores,
					'menu' => 'inspecciones',
					'title' => 'Nueva Inspección',
					'establecimiento' => $establecimiento,
					'regresar' => $regresar

				];
				//colocamos el error Solicitud incorrecta
				// $_SERVER['REDIRECT_STATUS'] == 'Solicitud incorrecta';
				//hacemos el insert
				$this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');

				$this->view('inspecciones/nueva_inspeccion', $parameters);

			}else{
				// print_r($errores);
				// die();
			
				if ($this->ModeloInspecciones->nuevaInspeccion($errores, $_POST['idestablecimiento'])) {
					$parameters = [

						'error' => FALSE,
						'title' => 'Nueva Inspeccion',
						'mensaje' => 'Se guardo el registro con exito',
						'menu' => 'inspecciones',
						'errores' => [],
						'establecimiento' => $establecimiento,
						'regresar' => $regresar
					];
					//colocamos el error todo ok
					// $_SERVER['REDIRECT_STATUS'] == 'OK';
					//hacemos el insert
					$this->ModeloBitacoras->insertBitacora($_SERVER, 'Exitosa');
					$this->view('inspecciones/nueva_inspeccion', $parameters);

				}else{
					echo 'No se puedo guardar el registro';
					//colocamos el error conflicto
					// $_SERVER['REDIRECT_STATUS'] == 'Conflicto';
					//hacemos el insert
					$this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');
					die();
				}

			}	

		}

		$establecimiento = $this->ModeloInspecciones->obtenerEstablecimiento1($id);
		$regresar = ROUTE_URL.'/inspecciones/inspeccionEstablecimiento/' . $pagina . '/' . $busqueda;

		// print_r($_SESSION);
			// echo ($_SESSION['user']->username);
		//esto ocurre cuando se ingresa a la vista nueva inspeccion			
		$parameters = [
			'error' => $this->error,
			'mensaje' => 'Complete los campos para realizar el registro.',
			'menu' => 'inspecciones',
			'title' => 'nueva Inspeccion',
			'menu' => 'inspecciones',
			'errores' => [],
			'establecimiento' => $establecimiento,
			'regresar' =>$regresar
			
		];
		
		$this->view('inspecciones/nueva_inspeccion', $parameters);

	}

} 