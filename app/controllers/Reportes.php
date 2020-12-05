<?php 

class Reportes extends MainController{

	function __construct(){
        // para probar ponemos sesionStart aca
        $this->error = FALSE;
		sessionAdmin();
        //ModeloInspecciones es donde estan todas las consultas con la base de datos
		$this->ModeloReportes = $this->model('ModeloReportes');

	}


	public function index(){
		$manipuladores = $this->ModeloReportes->obtenerManipuladores();


		$parameters =[
			'title'=> 'Reporte de Manipuladores',
			'menu' => 'manipuladores',
			'manipuladores' => $manipuladores,

		];

		$this->view('reportes/manipuladores', $parameters); 
	}
}




 ?>