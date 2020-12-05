<?php
class Bitacoras extends MainController
{
    public $error; 

    function __construct(){
        // para probar ponemos sesionStart aca
        sessionAdmin();
        //ModeloBitacoras es donde estan todas las consultas con la base de datos
        $this->ModeloBitacoras = $this->model('ModeloBitacoras');
        
    }
    //1-creando archivo index donde llevara la vista mostrando la tabla de bitacoras
    public function index($pagina = 1, $busqueda = null, $pos_pagina = 10){
        $rutaContrBusqueda = ROUTE_URL.'/bitacoras/index'; 

        $bitacora = null;
        $bitacoras = null;
        
        $bitacoras = $this->ModeloBitacoras->obtenerBitacoras();
        // echo $bitacoras[0]->fecha_log;
        // die();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$busqueda = ( $_POST['busqueda'] != '') ? sanitize(strtolower($_POST['busqueda'])) : null;

		}elseif ($busqueda != '') {
			$busqueda = str_replace('_', ' ',$busqueda);
			$busqueda = strtolower($busqueda);

		}
        
        $cuantosRegistros = $this->ModeloBitacoras->numeroRegistros($busqueda,'1');
        
		$respuesta = paginar_todo($cuantosRegistros , $pagina, $pos_pagina);

		if (!$respuesta['error']) {
            
            $bitacoras = $this->ModeloBitacoras->bitacorasPorLimite($pos_pagina, $respuesta['desde'], $busqueda);
        }
        //Estableciendo parametros para ser llamados en la vista 
        $parameters =[
            'title'=> 'Bitacoras',
            'menu' => 'bitacoras',
            'rutaContrBusqueda' => $rutaContrBusqueda,
            'respuesta' => $respuesta,
            'busqueda' => $busqueda,
            'bitacora' => $bitacora,
            'bitacoras' => $bitacoras,

        ];

        //2-Se llama la vista que se desea mostrar en pantalla
        $this->view('bitacoras/bitacoras', $parameters);
    }
} 