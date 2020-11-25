<?php

	/*mapeamos la URL
	1- Controlador
	2- Metodo
	3- Parametros*/

	class Core{

		protected $currentController = 'index';
		protected $currentMethod = 'index';
		protected $parameters = [];

		public function __construct(){
			$url = $this->getUrl();
			
			//Verificamos si el controlador enviado por url existe

			if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
				//si existe lo convertimos en el controlador actual
				$this->currentController = ucwords($url[0]);
				//eliminamos del arreglo el indice del controlador
				unset($url[0]);
			}
			
			//incluimos el nuevo controlador
			require_once('../app/controllers/' . $this->currentController . '.php');

			//creamos una instancia de la clase del controlador
			$this->currentController = new $this->currentController;

			//verificamos si se paso algun metodo por url
			if (isset($url[1])) {

				//verificamos si el metodo pasado por url existe
				if (method_exists($this->currentController, $url[1])) {

					//si existe lo convertimos en el metodo actual
					$this->currentMethod = $url[1];

					//eliminamos del arreglo el indice del metodo
					unset($url[1]);
				}

				//al eliminar de $url el controlador y el metodo solo nos quedarian los parametros con array_values crearemos un nuevo arreglo que contendra todos los parametros: mas info. http//php.net/manual/es/function.array-values.php

				$this->parameters = $url ? array_values($url) : [];
			}
			//hacemos un llamado del metodo de nuestra funcion y pasamos nuestros para metros
			call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);
			//print_r($this->parameters);
		}

		public function getUrl(){
			if(isset($_GET['url'])){
				$url = rtrim($_GET['url'], '/');
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;
			}
		}

	}
?>