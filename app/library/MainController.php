<?php
	// clase controlador principal
	class MainController{

		//cargamos el modelo
		public function model($model){
			require_once('../app/models/' . $model . '.php');
			return new $model();
		}

		// Cargamos la vista
		public function view($view, $parameters = []){
			if(file_exists('../app/views/' . $view . '.php')){
				require_once('../app/views/' . $view . '.php');
			}
			else{
				die('La vista no existe');
			}
		}
	}
?>