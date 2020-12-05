<?php 
class Establecimientos extends MainController{

	public $error;

	function __construct(){
        // para probar ponemos sesionStart aca
		$this->error = FALSE;
		sessionAdmin();
        //ModeloInspecciones es donde estan todas las consultas con la base de datos
		$this->ModeloEstablecimientos = $this->model('ModeloEstablecimientos');
		$this->ModeloBitacoras = $this->model('ModeloBitacoras');

	}



	public function verEstablecimiento($id = 0, $pagina, $estado, $busqueda = NULL){

		$establecimiento = $this->ModeloEstablecimientos->obtenerEstablecimiento($id, $estado);	

		if($estado == 'Activo'){
            $regresar = ROUTE_URL.'/establecimientos/index'.'/'.$pagina.'/0/0/'.$busqueda;
        }else{
            //$regresar = ROUTE_URL.'/establecimientos/establecimientosDesactivados'.'/0/0/'.$pagina.'/'.$busqueda;
             $regresar = ROUTE_URL.'/establecimientos/establecimientosDesactivados'.'/'.$pagina.'/0/0/'.$busqueda;
        }
		
		
		$parameters = [

			'title' => 'Ver Establecimiento',
			'error' => FALSE,
			'mensaje' => 'No se admite editar esablecimiento',		
			'menu' => 'establecimientos',
			'establecimiento' => $establecimiento,
			'regresar' => $regresar 
		];
		$this->view('establecimientos/ver_establecimiento', $parameters);
	}


	
	public function index($pagina = 1, $id = 0, $idE = 0,  $busqueda = null, $pos_pagina = 10){

		//carga la barra de busqueda
		$rutaContrBusqueda = ROUTE_URL.'/establecimientos/index'; 
		$establecimiento = null;
		$establecimientos = null;

		//$establecimientos = $this->ModeloEstablecimientos->obtenerEstablecimientos();

		

		if ($id > 0 && $this->ModeloEstablecimientos->obtenerEstablecimiento($id,'Activo')) {
			
			$establecimiento = $this->ModeloEstablecimientos->obtenerEstablecimiento($id,'Activo');	

		}
		if ($idE == 1 && $this->ModeloEstablecimientos->obtenerEstablecimiento($id,'Activo')) {
			
			$this->ModeloEstablecimientos->desactivar($id);
			$establecimiento = null;
		}	

		//si se presiono el boton de buscar
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//aqui lo que le estamos diciendo es que si se escribiio algo en la barra de busqueda
		//si esta lleno lo sanitiza y lo guarda en $busqueda de lo contrario 
		//sigue siendo null	
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		//cuando estamos en el metodo get y se ha buscado algo anteriormente
		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}
		
		$cuantosRegistros = $this->ModeloEstablecimientos->numeroRegistros($busqueda,'Activo');

		$respuesta = paginar_todo($cuantosRegistros, $pagina, $pos_pagina);

		if (!$respuesta['error']) {

			$establecimientos = $this->ModeloEstablecimientos->establecimientosPorLimite($pos_pagina, $respuesta['desde'], $busqueda, 'Activo');
		}

			 //Estableciendo parametros para ser llamados en la vista 
		$parameters =[
			'title'=> 'Establecimientos',
			'menu' => 'establecimientos',
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'respuesta' => $respuesta,
			'busqueda' => $busqueda,
			'establecimiento' => $establecimiento,
			'establecimientos' => $establecimientos,

		];

		$this->view('establecimientos/establecimientos', $parameters); 


	}







	public function desactivandoEstablecimiento($pagina = 1, $id = null, $idE = null , $busqueda = '', $pos_pagina = 5){
		$rutaContrBusqueda = ROUTE_URL.'/establecimientos';
		$busqueda = str_replace('_', ' ',$busqueda);
		
		// echo 'Desactivando Usuarios: '. $busqueda;
		// die();
		if ($id != null) {
			
			$idEliminar = $id;
			
			$establecimiento = $this->ModeloEstablecimientos->obtenerEstablecimiento($idEliminar);
			
			// print_r($usuario);
			// die();
			if (!$establecimiento) {

				
				$cuantosRegistros = $this->ModeloEstablecimientos->numeroRegistros();
				$establecimientos = $this->ModeloEstablecimientos->establecimientosPorLimite($pos_pagina, $respuesta['desde']);
				$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);
				$parameters = [

					'respuesta' => $respuesta,
					'establecimientos' => $establecimientos,
					'menu' => 'establecimientos',

				];
				$this->view('establecimientos/establecimientos', $parameters);
			}
			
		}

		if ($idE != 'borrar') {
			
			$establecimiento = null;
			$idEliminar = null;
			$this->ModeloEstablecimientos->desactivar($id);
			
		}
		// $busqueda = null;
		
		
		// echo 'sin nada';
		//obteniendo el numero total de registros
		
		
		
		if ($busqueda != '' ) {
			
			// echo $busqueda;
			// echo $busqueda;
			// die();
			
			$cuantosRegistros = $this->ModeloEstablecimientos->numeroRegistrosBusqueda($busqueda);
			
			
			// if ($cuantosRegistros == 0) {
				// 	header('location:usuarios/usuarios');
				// }
				// echo $cuantosRegistros;
				// echo 'Cuantos Registros: ' . $cuantosRegistros;
				// die();
			
		}else{
			
			$cuantosRegistros = $this->ModeloEstablecimientos->numeroRegistros();
		}
		// echo 'Pagina: '.$pagina;
		// echo ' cuantos Registros: '. $cuantosRegistros;
		// echo ' Pos Pagina: '. $pos_pagina;
		//devuelve 
		/* 
			-"total_paginas"
			-"pagina_actual"
        	-"pagina_siguiente"
        	-"pagina_anterior"
        	-"desde" ====> que seria el limite de registro o hasta donde trae los registros
		*/

        	$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		// print_r($respuesta);
		// die();
        	if ($cuantosRegistros == 0) {

        		$establecimientos = null;

        	}elseif ($cuantosRegistros > 0 and $busqueda != '') {
			// echo 'busqueda limite';
        		$establecimientos= $this->ModeloEstablecimientos->establecimientosPorLimiteBusqueda($pos_pagina, $respuesta['desde'], $busqueda);

			// print_r($usuarios);
			// die();
        	}else{

			// echo 'Solo limite';
			//traemos los registros para esta pagina
        		$establecimientos = $this->ModeloEstablecimientos->establecimientosPorLimite($pos_pagina, $respuesta['desde']);

        	}


		//eliminando un campo de la respuesta
		// unset($respuesta['desde']);
        	$parameters = [
        		'respuesta' => $respuesta,
        		'establecimientos' => $establecimientos,
        		'menu' => 'establecimientos',
        		'rutaContrBusqueda' => $rutaContrBusqueda,
        		'busqueda' => $busqueda,
        		'establecimiento' => $establecimiento,
        		'idEliminar' => $idEliminar,
        	];


        	$this->view('establecimientos/establecimientos', $parameters);
        }


        public function establecimientosDesactivados($pagina = 1, $id = 0, $idE = 0, $busqueda = null, $pos_pagina = 5){

        	$rutaContrBusqueda = ROUTE_URL.'/establecimientos/establecimientosDesactivados';
        	$establecimiento = null;
        	$establecimientos = null;

        	if ($id > 0 && $this->ModeloEstablecimientos->obtenerEstablecimiento($id)) {

        		$establecimiento = $this->ModeloEstablecimientos->obtenerEstablecimiento($id);	

        	}
        	if ($idE == 1 && $this->ModeloEstablecimientos->obtenerEstablecimiento($id)) {

				$this->ModeloEstablecimientos->activar($id);
				$inspeccion = $this->ModeloEstablecimientos->obtenerInspeccion($id);
				$this->ModeloEstablecimientos->reactivarInspeccion($inspeccion->inspec_para, 
																  NULL, 
																  $inspeccion->objeto_visita, 
																  $inspeccion->nombre_inspector,
																  NULL, 
																  NULL, 
																  NULL, 
																  NULL,
																  NULL, 
																  $inspeccion->id_estab,
																  $inspeccion->id_inspec
																);
        		$establecimiento = null;
        	}

        	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        		$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

        	}elseif ($busqueda != '') {
        		$busqueda = str_replace('_', ' ',$busqueda);
        		$busqueda = strtolower($busqueda);

        	}

        	$cuantosRegistros = $this->ModeloEstablecimientos->numeroRegistros($busqueda, 'Inactivo');

        	$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

        	if (!$respuesta['error']) {

        		$establecimientos = $this->ModeloEstablecimientos->establecimientosPorLimite($pos_pagina, $respuesta['desde'], $busqueda, 'Inactivo');
				//$usuarios = formatoEdad($usuarios);
        	}

        	$parameters = [

        		'title' => 'Establecimientos Desactivados',
        		'respuesta' => $respuesta,
        		'establecimientos' => $establecimientos,
        		'establecimiento' => $establecimiento,
        		'menu' => 'establecimientos',
        		'rutaContrBusqueda' => $rutaContrBusqueda,
        		'busqueda' => $busqueda,

        	];


        	$this->view('establecimientos/establecimientosDesactivados', $parameters);
        }













		// ----------------- Crear nuevo usuario--------------------
        public function nuevoEstablecimiento
        (){

        	$pagina=NULL; 
        	$busqueda = null;


		// ----------------- Recibiendo datos del formulario --------------------
        	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        		$regresar = ROUTE_URL.'/establecimientos/index'.'/'.$pagina.'/'.$busqueda;

			// ----------------- guardando los datos enviados por el formulario como propiedades --------------------
			//$data = $this->ModeloManipuladores->set_datos($_POST);



			// ------------------- Validando los campos del formulario ----------------------------

				/*$errores['establecimiento'] = validaNombre($_POST['establecimiento']);
				$this->error = ($errores['establecimiento']['form-control'] == 'error')? TRUE : $this->error;*/


			/*$errores['nombremanip'] = validaNombre($data->nombre_manip);
			$this->error = ($errores['nombremanip']['form-control'] == 'error')? TRUE : $this->error;
				print_r($errores['nombremanip']);
				die();*/


				$errores['nombre_estab'] = validaNombre($_POST['nombre_estab']);
				$this->error = ($errores['nombre_estab']['form-control'] == 'error')? TRUE : $this->error;
				//print_r($errores['nombremanip']);
				//die();

				$errores['nombre_prop'] = validaNombre($_POST['nombre_prop']);
				$this->error = ($errores['nombre_prop']['form-control'] == 'error')? TRUE : $this->error;

				$errores['apellido_prop'] = validaNombre($_POST['apellido_prop']);
				$this->error = ($errores['apellido_prop']['form-control'] == 'error')? TRUE : $this->error;

				$errores['dui_prop'] = validaDui($_POST['dui_prop']);
				$this->error = ($errores['dui_prop']['form-control'] == 'error')? TRUE :$this->error;

				$errores['direccion_estab'] = validaNombre($_POST['direccion_estab']);
				$this->error = ($errores['direccion_estab']['form-control'] == 'error')? TRUE : $this->error;

				$errores['cat_estab'] = validaNombre($_POST['cat_estab']);
				$this->error = ($errores['cat_estab']['form-control'] == 'error')? TRUE :$this->error;


				/*$errores['apartado_especifico'] = validaNombre($_POST['apartado_especifico']);
				$this->error = ($errores['apartado_especifico']['form-control'] == 'error')? TRUE :$this->error;*/


				$errores['telefono_estab'] = validatelefono($_POST['telefono_estab']);
				$this->error = ($errores['telefono_estab']['form-control'] == 'error')? TRUE :$this->error;


				$errores['municipio_estab'] = validaNombre($_POST['municipio_estab']);
				$this->error = ($errores['municipio_estab']['form-control'] == 'error')? TRUE :$this->error;


				$errores['departamento_estab'] = validaNombre($_POST['departamento_estab']);
				$this->error = ($errores['departamento_estab']['form-control'] == 'error')? TRUE :$this->error;





				$errores['tipo_estab'] = $_POST['tipo_estab'];
				$errores['apartado_especifico'] = $_POST['apartado_especifico'];

				
				

				if ($this->error == TRUE) { 

					

					$parameters = [
						'title' => 'Nuevo Establecimiento',
						'error' => $this->error,
						'mensaje' => 'Revise los campos de entrada <i style = "color:#FF0000;" class="fas fa-exclamation-circle"></i>',
						'errores' => $errores,
						'menu' => 'establecimientos',
						'regresar' => $regresar,

					];
					$this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');
					$this->view('establecimientos/nuevo_establecimiento', $parameters);

				}else  	{

					if ($this->ModeloEstablecimientos->nuevoEstablecimiento($errores, $_SESSION['user']->username)) {

						$parameters = [
							'title' => 'Nuevo Establecimiento',
							'error' => FALSE,
							'mensaje' => 'Se guardo el registro con exito <i style = "color: #008f39;"class="fas fa-check-circle"></i>',
							'menu' => 'establecimientos',
							'errores' => [],
							'regresar' => $regresar,
						];

						$this->ModeloBitacoras->insertBitacora($_SERVER, 'Exitosa');
						$this->view('establecimientos/nuevo_establecimiento', $parameters);
					}else{
						echo 'No se puedo guardar el registro';
						$this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');
						die();
					}
				}
			}
			

			$regresar = ROUTE_URL.'/establecimientos/index'.'/'.$pagina.'/'.$busqueda;
			$parameters = [
				'error' => $this->error,
				'mensaje' => 'Complete los campos para realizar el registro.',
				'menu' => 'establecimientos',
				'title' => 'Nuevo Establecimiento',
				'menu' => 'establecimientos',
				'errores' => [],
				'regresar' => $regresar,
			];
			
			$this->view('establecimientos/nuevo_establecimiento', $parameters);

		}









		public function actualizarEstablecimiento($id = 0 ,$pagina = 1, $busqueda = NULL){

		

			$regresar = ROUTE_URL.'/establecimientos/index'.'/'.$pagina.'/0/0/'.$busqueda;


		//comprobando si el usuario existe a traves del id
			if (!$this->ModeloEstablecimientos->obtenerEstablecimiento($id, 'Activo')) {
			//	$errores['pass']['pass'] = '';

				$parameters = [

					'error' => TRUE,
					'mensaje' => 'Este registro ya no existe',
					'errores' => [],
					'menu' => 'establecimientos',
					'regresar' => $regresar

				];

				$this->view('establecimientos/actualizar_establecimiento', $parameters);
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$regresar =$_POST['regresar'];

			// ----------------- guardando los datos enviados por el formulario como propiedades --------------------
				//$data = $this->ModeloEstablecimientos->set_datos($_POST);

			// ------------------- Validando los campos del formulario ----------------------------
					$errores['nombre_estab'] = validaNombre($_POST['nombre_estab']);
				$this->error = ($errores['nombre_estab']['form-control'] == 'error')? TRUE : $this->error;
				//print_r($errores['nombremanip']);
				//die();

				$errores['nombre_prop'] = validaNombre($_POST['nombre_prop']);
				$this->error = ($errores['nombre_prop']['form-control'] == 'error')? TRUE : $this->error;

				$errores['apellido_prop'] = validaNombre($_POST['apellido_prop']);
				$this->error = ($errores['apellido_prop']['form-control'] == 'error')? TRUE : $this->error;

				$errores['dui_prop'] = validaDui($_POST['dui_prop']);
				$this->error = ($errores['dui_prop']['form-control'] == 'error')? TRUE :$this->error;

				$errores['direccion_estab'] = validaNombre($_POST['direccion_estab']);
				$this->error = ($errores['direccion_estab']['form-control'] == 'error')? TRUE : $this->error;

				$errores['cat_estab'] = validaNombre($_POST['cat_estab']);
				$this->error = ($errores['cat_estab']['form-control'] == 'error')? TRUE :$this->error;


				/*$errores['apartado_especifico'] = validaNombre($_POST['apartado_especifico']);
				$this->error = ($errores['apartado_especifico']['form-control'] == 'error')? TRUE :$this->error;*/


				$errores['telefono_estab'] = validatelefono($_POST['telefono_estab']);
				$this->error = ($errores['telefono_estab']['form-control'] == 'error')? TRUE :$this->error;


				$errores['municipio_estab'] = validaNombre($_POST['municipio_estab']);
				$this->error = ($errores['municipio_estab']['form-control'] == 'error')? TRUE :$this->error;


				$errores['departamento_estab'] = validaNombre($_POST['departamento_estab']);
				$this->error = ($errores['departamento_estab']['form-control'] == 'error')? TRUE :$this->error;





				$errores['tipo_estab'] = $_POST['tipo_estab'];
				$errores['apartado_especifico'] = $_POST['apartado_especifico'];


				if ($this->error == TRUE) {

					$parameters = [
						'title' => 'Editar Establecimiento',
						'error' => $this->error,
						'mensaje' => 'Revise los campos de entrada <i style = "color:#FF0000;" class="fas fa-exclamation-circle"></i>',
						'errores' => $errores,
						'menu' => 'establecimientos',
						'establecimiento' => $id,
						'regresar' => $regresar
					];

					$this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');
					$this->view('establecimientos/actualizar_establecimiento', $parameters);

				}else{

				/*	$errores['pass']['text'] = hash('sha512', $errores['pass']['text']);*/

					if ($this->ModeloEstablecimientos->actualizarEstablecimiento($id, $errores, $_SESSION['user']->username)) {

						//$errores['pass']['text'] = '';

						$parameters = [

							'title' => 'Editar Establecimiento',
							'error' => FALSE,
							'mensaje' => 'Se actualizo el registro correctamente <i style = "color: #008f39;"class="fas fa-check-circle"></i>',
							'menu' => 'establecimientos',
							'errores' => $errores,
							'menu' => 'establecimientos',
							'regresar' => $regresar

						];
						$this->ModeloBitacoras->insertBitacora($_SERVER, 'Exitosa');
						$this->view('establecimientos/actualizar_establecimiento', $parameters);

					}else{

						echo 'No se puedo actualizar el registro';
						$this->ModeloBitacoras->insertBitacora($_SERVER, 'No exitosa');
						die();

					}
				}

			}else{

				$establishment = $this->ModeloEstablecimientos->obtenerEstablecimiento($id, 'Activo');

				$errores['nombre_estab']['text'] = $establishment->nombre_estab;

				$errores['nombre_prop']['text'] = $establishment->nombre_prop;

				$errores['apellido_prop']['text'] = $establishment->apellido_prop;

				$errores['dui_prop']['text'] = $establishment->dui_prop;

				$errores['direccion_estab']['text'] = $establishment->direccion_estab;

				$errores['cat_estab']['text'] = $establishment->cat_estab;

				$errores['nombre_estab']['text'] = $establishment->nombre_estab;

				$errores['tipo_estab'] = $establishment->tipo_estab;

				$errores['apartado_especifico'] = $establishment->apartado_especifico;

				$errores['telefono_estab']['text'] = $establishment->telefono_estab;


				$errores['municipio_estab']['text'] = $establishment->municipio_estab;

				$errores['departamento_estab']['text'] = $establishment->departamento_estab;



			

				$parameters = [

					'title' => 'Editar Establecimiento',
					'error' => 2,
					'mensaje' => 'Edite los campos de entrada',
					'errores' => $errores,
					'menu' => 'usuarios',
					'establecimiento' => $id,
					'regresar' => $regresar
				];


				$this->view('establecimientos/actualizar_establecimiento', $parameters);
			}
		}

















	}

	?>