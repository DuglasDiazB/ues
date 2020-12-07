<?php 
class Reports extends MainController{


	function __construct(){

		$this->error = FALSE;
		sessionAdmin();
		$this->ModeloReportes = $this->model('ModeloReportes');

	}

	public function index(){
		//$manipuladores = $this->ModeloReportes->obtenerManipuladores();


		$parameters =[
			'title'=> 'Reports',

			'menu' => 'reports',
			//'rutaContrBusqueda' => $rutaContrBusqueda,
			//'respuesta' => $respuesta,
			//'busqueda' => $busqueda,
			//'manipulador' => $manipulador,
			//'manipuladores' => $manipuladores,*/

		];

		$this->view('reportes/index', $parameters); 

	}







public function wrap(){

	$manipuladores = $this->ModeloReportes->obtenerManipuladores();

		$parameters = [
			'title'=> 'Active Manipulators Report',
			'manipuladores'=>$manipuladores,
		];



	$this->view('reportes/wrap', $parameters);

}


public function Credencial($id, $estadoCreden = 'Activo'){

	$credencial = $this->ModeloReportes->generarCredencial($id, $estadoCreden);

		$parameters = [
			'title'=> 'Credencial',
			'credencial'=>$credencial,
		];



	$this->view('reportes/ver_credencial', $parameters);


}	











/*FUNCIONES PARA LOS REPORTES DEL MODULO DE USUARIOS*/

public function reporteUsuarios(){
		$usuarios = $this->ModeloReportes->obtenerUsuarios();

		$parameters = [
			'title'=> 'Active Manipulators Report',
			'usuarios'=>$usuarios,
		];
		$this->view('reportes/usuarios', $parameters);
	}

public function reporteUsuariosActivos(){
		$usuarios = $this->ModeloReportes->obtenerUsuariosActivos();

		$parameters = [
			'title'=> 'Usuarios Activos',
			'usuarios'=>$usuarios,
		];
		$this->view('reportes/usuarios_activos', $parameters);
	}



public function reporteUsuariosInactivos(){
		$usuarios = $this->ModeloReportes->obtenerUsuariosInactivos();

		$parameters = [
			'title'=> 'Usuarios Inactivos',
			'usuarios'=>$usuarios,
		];
		$this->view('reportes/usuarios_inactivos', $parameters);
	}			





/*---------------FUNCIONES PARA LOS REPORTES DEL MODULO DE MANIPULADORES-------------------------*/
	public function reporteManipuladores(){
		$manipuladores = $this->ModeloReportes->obtenerManipuladores();

		$parameters = [
			'title'=> 'Active Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores', $parameters);
	}


	public function reporteManipuladoresActivos(){
		$manipuladores = $this->ModeloReportes->reporteManipuladoresActivos();

		$parameters = [
			'title'=> 'Active Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores_activos', $parameters);
	}

	public function reporteManipuladoresInactivos(){
		$manipuladores = $this->ModeloReportes->reporteManipuladoresInactivos();

		$parameters = [
			'title'=> 'Deactivated Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores_inactivos', $parameters);
	}

	public function reporteManipuladoresFormales(){
		$manipuladores = $this->ModeloReportes->reporteManipuladoresFormales();

		$parameters = [
			'title'=> 'Formal Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores_formales', $parameters);
	}


	public function reporteManipuladoresInformales(){
		$manipuladores = $this->ModeloReportes->reporteManipuladoresInformales();

		$parameters = [
			'title'=> 'Informal Manipulators Report',
			'manipuladores'=>$manipuladores,
		];
		$this->view('reportes/manipuladores_informales', $parameters);
	}


/*---------------FUNCIONES PARA LOS REPORTES DEL MODULO DE ESTABLECIMIENTOS-------------------------*/


public function reporteEstablecimientos(){
		$establecimientos = $this->ModeloReportes->obtenerEstablecimientos();

		$parameters = [
			'title'=> 'Establecimientos',
			'establecimientos'=>$establecimientos,
		];
		$this->view('reportes/establecimientos', $parameters);
	}


public function reporteEstablecimientosActivos(){
		$establecimientos = $this->ModeloReportes->obtenerEstablecimientosActivos();

		$parameters = [
			'title'=> 'Establecimientos Activos',
			'establecimientos'=>$establecimientos,
		];
		$this->view('reportes/establecimientos_activos', $parameters);
	}



public function reporteEstablecimientosInactivos(){
		$establecimientos = $this->ModeloReportes->obtenerEstablecimientosInactivos();

		$parameters = [
			'title'=> 'Establecimientos Inactivos',
			'establecimientos'=>$establecimientos,
		];
		$this->view('reportes/establecimientos_inactivos', $parameters);
	}

public function reporteEstablecimientosA(){
		$establecimientos = $this->ModeloReportes->obtenerEstablecimientosA();

		$parameters = [
			'title'=> 'Establecimientos A',
			'establecimientos'=>$establecimientos,
		];
		$this->view('reportes/establecimientos_a', $parameters);
	}

public function reporteEstablecimientosB(){
		$establecimientos = $this->ModeloReportes->obtenerEstablecimientosB();

		$parameters = [
			'title'=> 'Establecimientos B',
			'establecimientos'=>$establecimientos,
		];
		$this->view('reportes/establecimientos_b', $parameters);
	}


public function reporteEstablecimientosC(){
		$establecimientos = $this->ModeloReportes->obtenerEstablecimientosC();

		$parameters = [
			'title'=> 'Establecimientos C',
			'establecimientos'=>$establecimientos,
		];
		$this->view('reportes/establecimientos_c', $parameters);
	}	

public function reporteEstablecimientosD(){
		$establecimientos = $this->ModeloReportes->obtenerEstablecimientosD();

		$parameters = [
			'title'=> 'Establecimientos D',
			'establecimientos'=>$establecimientos,
		];
		$this->view('reportes/establecimientos_d', $parameters);
	}


/*---------------FUNCIONES PARA LOS REPORTES DEL MODULO DE ESTABLECIMIENTOS-------------------------*/

public function reporteInspecciones(){
		$inspecciones = $this->ModeloReportes->obtenerInspeciones();

		$parameters = [
			'title'=> 'Inspecciones',
			'inspecciones'=>$inspecciones,
		];
		$this->view('reportes/inspecciones', $parameters);
	}




/*-----------------------COPIA DE SEGURIDAD-------------------------------------------*/

	public function copiaSeguridad(){
		
		$regresar = ROUTE_URL.'/Reports/index/';

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			
			$errores['password']['text'] = $_POST['password'];
			
			if ($errores['password']['text'] == '') {
				
				$mensaje = 'Revise el campo de entrada de texto <i style = "color: 	#FF0000;" class="fas fa-exclamation-circle"></i>';
				$errores['password']['form-control'] = 'error';
				$errores['password']['small'] = 'No ha digitado ninguna contraseña';
				
			}else{

				$usuario = ucwords($_SESSION['user']->username);
				
				$pass = sanitize(hash('sha512',  $errores['password']['text']));

				if($this->ModeloReportes->comprobarUser($usuario, $pass)){
								
					$arrayDbConf['host'] = DB_HOST;
					$arrayDbConf['user'] = DB_USER;
					$arrayDbConf['pass'] = DB_PASS;
					$arrayDbConf['name'] = DB_NAME;
					
					$fecha = date("Ymd-His");

					
					$bck = new MySqlBackupLite($arrayDbConf);
					$bck->backUp();
					$bck->setFileDir('C:\xampp\htdocs\ues\backup/');
					$bck->setFileName($arrayDbConf['name'].'_'.$fecha.'.sql');
					$bck->saveToFile();
					$errores['password']['form-control'] = 'success';
					
					$mensaje = 'La base de datos fue generada correctamente <i style = "color: #008f39;"class="fas fa-check-circle"></i>';
								
				}else{
					$mensaje = 'Ha ocurrido un error al procesar la contraseña <i style = "color: 	#FF0000;" class="fas fa-exclamation-circle"></i>';
					$errores['password']['form-control'] = 'error';
					$errores['password']['small'] = 'Contraseña invalida';
				}
			
			}
		}else{

			$mensaje = 'Digite su contraseña de administrador para descargar una copia de la base de datos';
			$errores['password']['form-control'] = '';
			$errores['password']['text'] = '';
			$errores['password']['small'] = '';

		}
		
		$parameters = [
			'title' => 'Copia de Seguridad',
			'mensaje' => $mensaje,
			'errores' => $errores, 
			'regresar' => $regresar

		];

		

		$this->view('reportes/copia_seguridad', $parameters);
	}
}


?>