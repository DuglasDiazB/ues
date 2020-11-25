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

			/*'menu' => 'manipuladores',
			'rutaContrBusqueda' => $rutaContrBusqueda,
			'respuesta' => $respuesta,
			'busqueda' => $busqueda,
			'manipulador' => $manipulador,
			'manipuladores' => $manipuladores,*/

		];

		$this->view('reportes/index', $parameters); 

	}


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
}


?>