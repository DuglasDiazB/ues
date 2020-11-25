<?php 
class Manipuladores extends MainController{

	public $error;

	function __construct(){
        // para probar ponemos sesionStart aca
        $this->error = FALSE;
		sessionAdmin();
        //ModeloInspecciones es donde estan todas las consultas con la base de datos
		$this->ModeloManipuladores = $this->model('ModeloManipuladores');

	}






	/*public function verManipulador($id = 0, $pagina, $estado, $busqueda = null){*/

	public function verManipulador($id, $estado){

		$manipulador = $this->ModeloManipuladores->obtenerManipulador($id, $estado);	
		
		
		$parameters = [

			'title' => 'Ver Manipulador',
			'error' => FALSE,
			'mensaje' => 'No se admite editar manipulador',		
			'menu' => 'manipuladores',
			'manipulador' => $manipulador
		];
		$this->view('manipuladores/ver_manipulador', $parameters);
	}


	
	public function index($pagina = 1, $id = 0, $idE = 0,  $busqueda = null, $pos_pagina = 10){

		//carga la barra de busqueda
		$rutaContrBusqueda = ROUTE_URL.'/manipuladores/index'; 
		$manipulador = null;
		$manipuladores = null;
	

		//echo $_SESSION['user']->username;

	

           

		/*$manipuladores = $this->ModeloManipuladores->obtenerManipuladores();
		print_r($manipuladores);*/

		/*$ultimo = $this->ModeloManipuladores->lastIdInsert();
		print_r($ultimo);
		die();*/

		/*$last = $this->ModeloManipuladores->getUserMaxValue();
		print_r($last);
		die();*/
	

		if ($id > 0 && $this->ModeloManipuladores->obtenerManipulador($id,'Activo')) {
			
			$manipulador = $this->ModeloManipuladores->obtenerManipulador($id,'Activo');	

		}
		if ($idE == 1 && $this->ModeloManipuladores->obtenerManipulador($id,'Activo')) {
			
			$this->ModeloManipuladores->desactivar($id);
			$manipulador = null;
		}	

		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}
		
		$cuantosRegistros = $this->ModeloManipuladores->numeroRegistros($busqueda,'Activo');

		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {

			$manipuladores = $this->ModeloManipuladores->manipuladoresPorLimite($pos_pagina, $respuesta['desde'], $busqueda, 'Activo');
		}

			 //Estableciendo parametros para ser llamados en la vista 
		$parameters =[
			'title'=> 'Manipuladores',
			'menu' => 'manipuladores',
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'respuesta' => $respuesta,
			'busqueda' => $busqueda,
			'manipulador' => $manipulador,
			'manipuladores' => $manipuladores,

		];

		$this->view('manipuladores/manipuladores', $parameters); 


	}







		public function desactivandoManipulador($pagina = 1, $id = null, $idE = null , $busqueda = '', $pos_pagina = 5){
		$rutaContrBusqueda = ROUTE_URL.'/manipuladores';
		$busqueda = str_replace('_', ' ',$busqueda);
		
		// echo 'Desactivando Usuarios: '. $busqueda;
		// die();
		if ($id != null) {
			
			$idEliminar = $id;
			
			$manipulador = $this->ModeloManipuladores->obtenerManipulador($idEliminar);
			
			// print_r($usuario);
			// die();
			if (!$manipulador) {

				
				$cuantosRegistros = $this->ModeloManipuladores->numeroRegistros();
				$manipuladores = $this->ModeloManipuladores->manipuladoresPorLimite($pos_pagina, $respuesta['desde']);
				$respuesta  = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);
				$parameters = [

					'respuesta' => $respuesta,
					'manipuladores' => $manipuladores,
					'menu' => 'manipuladores',

				];
				$this->view('manipuladores/manipuladores', $parameters);
			}
			
		}

		if ($idE != 'borrar') {
			
			$manipulador = null;
			$idEliminar = null;
			$this->ModeloManipuladores->desactivar($id);
			
		}
		// $busqueda = null;
		
		
		// echo 'sin nada';
		//obteniendo el numero total de registros
		
		
		
		if ($busqueda != '' ) {
			
			// echo $busqueda;
			// echo $busqueda;
			// die();
			
			$cuantosRegistros = $this->ModeloManipuladores->numeroRegistrosBusqueda($busqueda);
			
			
			// if ($cuantosRegistros == 0) {
				// 	header('location:usuarios/usuarios');
				// }
				// echo $cuantosRegistros;
				// echo 'Cuantos Registros: ' . $cuantosRegistros;
				// die();
			
		}else{
			
			$cuantosRegistros = $this->ModeloManipuladores->numeroRegistros();
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
			
			$manipuladores = null;

		}elseif ($cuantosRegistros > 0 and $busqueda != '') {
			// echo 'busqueda limite';
			$manipuladores = $this->ModeloManipuladores->manipuladoresPorLimiteBusqueda($pos_pagina, $respuesta['desde'], $busqueda);
			
			// print_r($usuarios);
			// die();
		}else{
			
			// echo 'Solo limite';
			//traemos los registros para esta pagina
			$manipuladores = $this->ModeloManipuladores->manipuladoresPorLimite($pos_pagina, $respuesta['desde']);

		}
		
		
		//eliminando un campo de la respuesta
		// unset($respuesta['desde']);
		$parameters = [
			'respuesta' => $respuesta,
			'manipuladores' => $manipuladores,
			'menu' => 'manipuladores',
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'busqueda' => $busqueda,
			'manipulador' => $manipulador,
			'idEliminar' => $idEliminar,
		];

		
		$this->view('manipuladores/manipuladores', $parameters);
	}


		public function manipuladoresDesactivados($pagina = 1, $id = 0, $idE = 0, $busqueda = null, $pos_pagina = 5){

			$rutaContrBusqueda = ROUTE_URL.'/manipuladores/manipuladoresDesactivados';
			$manipulador = null;
			$manipuladores = null;

			if ($id > 0 && $this->ModeloManipuladores->obtenerManipulador($id)) {

				$manipulador = $this->ModeloManipuladores->obtenerManipulador($id);	

			}
			if ($idE == 1 && $this->ModeloManipuladores->obtenerManipulador($id)) {

				$this->ModeloManipuladores->activar($id);
				$manipulador = null;
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

			}elseif ($busqueda != '') {
				$busqueda = str_replace('_', ' ',$busqueda);
				$busqueda = strtolower($busqueda);

			}

			$cuantosRegistros = $this->ModeloManipuladores->numeroRegistros($busqueda, 'Inactivo');

			$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

			if (!$respuesta['error']) {

				$manipuladores = $this->ModeloManipuladores->manipuladoresPorLimite($pos_pagina, $respuesta['desde'], $busqueda, 'Inactivo');
				//$usuarios = formatoEdad($usuarios);
			}

			$parameters = [
				
				'title' => 'Manipuladores Desactivados',
				'respuesta' => $respuesta,
				'manipuladores' => $manipuladores,
				'manipulador' => $manipulador,
				'menu' => 'manipuladores',
				'rutaContrBusqueda' => $rutaContrBusqueda,
				'busqueda' => $busqueda,

			];


			$this->view('manipuladores/manipuladoresDesactivados', $parameters);
		}


////////////////////////////////////////////////////////////////////////////////////

		// ----------------- Crear nuevo usuario--------------------
	public function nuevoManipulador(){

		$establecimiento = $this->ModeloManipuladores->obtenerManipuladores();

		/*$parameters = [
			'title' => 'Nuevo Manipulador',
			'error' => FALSE,
			'mensaje' => '',
			'menu' => 'manipuladores',
			'errores' => [],
			'establecimiento' => $establecimiento,
		];
		$this->view('manipuladores/nuevo_manipulador', $parameters);*/
	

		

		
		// ----------------- Recibiendo datos del formulario --------------------
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// ----------------- guardando los datos enviados por el formulario como propiedades --------------------
			//$data = $this->ModeloManipuladores->set_datos($_POST);


			
			// ------------------- Validando los campos del formulario ----------------------------

				/*$errores['establecimiento'] = validaNombre($_POST['establecimiento']);
				$this->error = ($errores['establecimiento']['form-control'] == 'error')? TRUE : $this->error;*/


			/*$errores['nombremanip'] = validaNombre($data->nombre_manip);
			$this->error = ($errores['nombremanip']['form-control'] == 'error')? TRUE : $this->error;
				print_r($errores['nombremanip']);
				die();*/


				$errores['nombremanip'] = validaNombre($_POST['nombremanip']);
				$this->error = ($errores['nombremanip']['form-control'] == 'error')? TRUE : $this->error;
				//print_r($errores['nombremanip']);
				//die();


				$errores['apellidomanip'] = validaNombre($_POST['apellidomanip']);
				$this->error = ($errores['apellidomanip']['form-control'] == 'error')? TRUE : $this->error;

				$errores['fechaNacimiento'] = validafecha($_POST['fechaNacimiento']);
				$this->error = ($errores['fechaNacimiento']['form-control'] == 'error')? TRUE :$this->error;
				
				$errores['duimanip'] = validaDui($_POST['duimanip']);
				$this->error = ($errores['duimanip']['form-control'] == 'error')? TRUE :$this->error;

				$errores['puestomanip'] = validaNombre($_POST['puestomanip']);
				$this->error = ($errores['puestomanip']['form-control'] == 'error')? TRUE : $this->error;



				$errores['generomanip'] = $_POST['generomanip'];
				$errores['asistencia_check'] = $_POST['asistencia_check'];
				$errores['id_estab'] = $_POST['id_estab'];
				

				if ($this->error == TRUE) {

					echo $this->error;

					$parameters = [
						'title' => 'Nuevo Manipulador',
						'error' => $this->error,
						'mensaje' => 'Revise los campos de entrada',
						'errores' => $errores,
						'menu' => 'manipuladores',
						'establecimiento' => $establecimiento,

					];

					$this->view('manipuladores/nuevo_manipulador', $parameters);

				}else  	{

					if ($this->ModeloManipuladores->nuevoManipulador($errores, $_SESSION['user']->username)) {

						$parameters = [
							'title' => 'Nuevo Manipulador',
							'error' => FALSE,
							'mensaje' => 'Se guardo el registro con exito',
							'menu' => 'manipuladores',
							'establecimiento' => $establecimiento,
							'errores' => [],
						];

						$this->view('manipuladores/nuevo_manipulador', $parameters);

					}else{
						echo 'No se puedo guardar el registro';
						die();
					}
				}
			}

		
	
			
		

			$parameters = [
				'error' => $this->error,
				'mensaje' => 'Complete los campos para realizar el registro.',
				'menu' => 'manipuladores',
				'title' => 'Nuevo Manipulador',
				'menu' => 'manipuladores',
				'establecimiento' => $establecimiento,
				'errores' => [],
			];
			
			$this->view('manipuladores/nuevo_manipulador', $parameters);








		

		}





			public function actualizarManipulador($id = 0, $pagina = 1){

			

		//comprobando si el usuario existe a traves del id
			if (!$this->ModeloManipuladores->obtenerManipulador($id, 'Activo')) {
			//	$errores['pass']['pass'] = '';

				$parameters = [

					'error' => TRUE,
					'mensaje' => 'Este registro ya no existe',
					'establecimiento' => $establecimiento,
					'errores' => [],
					'menu' => 'manipuladores',

				];

				$this->view('manipuladores/actualizar_manipulador', $parameters);
			}
			//presionando el boton
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$establecimiento = $this->ModeloManipuladores->getEstab($_POST['id_estab']);
			
			// ----------------- guardando los datos enviados por el formulario como propiedades --------------------
				//$data = $this->ModeloEstablecimientos->set_datos($_POST);

			// ------------------- Validando los campos del formulario ----------------------------
					$errores['nombremanip'] = validaNombre($_POST['nombremanip']);
				$this->error = ($errores['nombremanip']['form-control'] == 'error')? TRUE : $this->error;
				//print_r($errores['nombremanip']);
				//die();


				$errores['apellidomanip'] = validaNombre($_POST['apellidomanip']);
				$this->error = ($errores['apellidomanip']['form-control'] == 'error')? TRUE : $this->error;

				$errores['fechaNacimiento'] = validafecha($_POST['fechaNacimiento']);
				$this->error = ($errores['fechaNacimiento']['form-control'] == 'error')? TRUE :$this->error;
				
				$errores['duimanip'] = validaDui($_POST['duimanip']);
				$this->error = ($errores['duimanip']['form-control'] == 'error')? TRUE :$this->error;

				$errores['puestomanip'] = validaNombre($_POST['puestomanip']);
				$this->error = ($errores['puestomanip']['form-control'] == 'error')? TRUE : $this->error;

				$errores['nombre_estab'] = $establecimiento->nombre_estab;


				$errores['generomanip'] = $_POST['generomanip'];
				$errores['asistencia_check'] = $_POST['asistencia_check'];
				$errores['id_estab'] = $_POST['id_estab'];
				
				$establecimientos = $this->ModeloManipuladores->obtenerManipuladores();			
			
				$manipulator = $this->ModeloManipuladores->obtenerManipulador($id, 'Activo');

				// Existe algun error en el formulario
				if ($this->error == TRUE) {
				
					$parameters = [
						'title' => 'Editar Manipulador',
						'error' => $this->error,
						'mensaje' => 'Revise los campos de entrada',
						'establecimiento' => $establecimiento,
						'errores' => $errores,
						'menu' => 'manipuladores',
						'establecimiento' => $manipulator,
						'establecimientos'=> $establecimientos,
						'manipulador' => $id,
					];


					$this->view('manipuladores/actualizar_manipulador', $parameters);

				//No existen errores en el formulario
				}else{

				/*	$errores['pass']['text'] = hash('sha512', $errores['pass']['text']);*/

					if ($this->ModeloManipuladores->actualizarManipulador($id, $errores, $_SESSION['user']->username)) {

						//$errores['pass']['text'] = '';

						$parameters = [

							'title' => 'Editar Manipulador',
							'error' => FALSE,
							'mensaje' => 'Se actualizo el registro correctamente',
							'menu' => 'manipuladores',
							'establecimiento' => $manipulator,
							'establecimientos'=> $establecimientos,
							'errores' => $errores,
							'menu' => 'manipuladores',

						];
						$this->view('manipuladores/actualizar_manipulador', $parameters);

					}else{

						echo 'No se puedo actualizar el registro';
						die();

					}
				}

			}else{

				
				$establecimientos = $this->ModeloManipuladores->obtenerManipuladores();			

				$manipulator = $this->ModeloManipuladores->obtenerManipulador($id, 'Activo');

																	
				$errores['duimanip']['text'] = $manipulator->dui_manip;
				$errores['nombremanip']['text'] = $manipulator->nombre_manip;
				$errores['apellidomanip']['text'] = $manipulator->apellido_manip;
				$errores['generomanip'] = $manipulator->genero_manip;
				$errores['asistencia_check'] = $manipulator->asistencia_check;
				$errores['fechaNacimiento']['text'] = $manipulator->fecha_nacim_manip;
				$errores['puestomanip']['text'] = $manipulator->puesto_manip;
				$errores['duimanip']['text'] = $manipulator->dui_manip;
				$errores['id_estab'] = $manipulator->id_estab;
				$errores['nombre_estab'] = $manipulator->nombre_estab;



				$parameters = [

					'title' => 'Editar Manipulador',
					'error' => 2,
					'mensaje' => 'Edite los campos de entrada',
					'errores' => $errores,
					'menu' => 'manipuladores',
					'establecimiento' => $manipulator,
					'establecimientos'=> $establecimientos,
					'manipulador' => $id,
				];


				$this->view('manipuladores/actualizar_manipulador', $parameters);
			}
		}





	











	}

	?>