<?php 
class ModeloManipuladores{

	private $db;
	public $id_manip;
	public $dui_manip;
	public $nombre_manip;
	public $apellido_manip;
	public $genero_manip;
	public $fecha_nacim_manip;
	public $puesto_manip;
	public $token;
	public $estado_manip;
	public $id_estab;
	public $nombre_estab;
	public $asistencia_check;

	public function __construct(){
		$this->db = new Sql;
	}


        //Asignado valores del formulario a cada propiedad si esta existe
	public function set_datos($datos){

		foreach ($datos as $nombre_campo => $valor_campo) {

			if (property_exists('ModeloManipuladores', $nombre_campo)) {

				$this->$nombre_campo = $valor_campo;
			}
		}
		return $this;
	}

	
	public function lastIdInsert(){
		$this->db->query('SELECT @@identity  as id_manip from tblmanipuladores');
		return $this->db->register();
	}

	public function getUserMaxValue(){
		$this->db->query('SELECT MAX(id_manip) as idmax FROM tblmanipuladores');
		return $this->db->register();
	}

	public function getEstab($idEstab = 0){

		$this->db->query("SELECT nombre_estab  FROM tblestablecimientos WHERE id_estab = '$idEstab'");
		return $this->db->register();

	}	


         //DONDE SE CREARAN LAS CONSULTAS

        //****************************************************************************************************************************** */
        //1-creando archivo index donde llevara la vista mostrando la tabla de inspecciones
	public function obtenerManipuladores(){

		//$this->db->query("SELECT * FROM tblmanipuladores");

		/*$this->db->query("SELECT nombre_manip, apellido_manip, dui_manip, puesto_manip, estado_manip, nombre_estab FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab    WHERE estado_estab = 'Activo'");*/

		$this->db->query("SELECT id_estab, nombre_estab FROM tblestablecimientos WHERE estado_estab = 'Activo'");

		return $this->db->registers();
	}
	/*///////////////////////////////////////////////////////////////////////////*/


	public function obtenerManipulador($id, $estado = 'Inactivo'){
		$this->db->query("SET lc_time_names = 'es_ES'");
		$this->db->execute();
		$this->db->query(
			"SELECT tblmanipuladores.id_manip,
			dui_manip,
			nombre_manip,
			apellido_manip,
			genero_manip,
			fecha_nacim_manip,
			puesto_manip,
			estado_manip,
			tblmanipuladores.id_estab,
			tblestablecimientos.tipo_estab,
			nombre_estab,
			asistencia_check,
			tblmanipuladores.usermod,


			DATE_FORMAT(fecha_mod_manip, 'ultima modificación %W %d de %M del %Y a las %H:%i') as fecha_mod_manip,
			fecha_registro_manip
			FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab
			WHERE tblmanipuladores.id_manip = :id and estado_manip = '$estado'");
		$this->db->bind(':id', $id);
		return $this->db->register();
	}

	/*///////////////////////////////////////////////////////////////////////////*/

	   //Haciendo las busquedas por el numero de registro
	public function numeroRegistros($busqueda = null, $estado = 'Activo'){


		if ($busqueda != null && strpos($busqueda, ' ')) {

			$busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
			for($i = 0; $i < count($busquedaNombre); $i++){
				$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
			}
		        // convirtiendo el arreglo a str
			$busqueda = implode($busquedaNombre);

			$this->db->query(
				"SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab
				WHERE( LOWER(CONCAT(nombre_manip,apellido_manip)) LIKE '$busqueda' OR
				LOWER(CONCAT(apellido_manip,' ',nombre_manip)) LIKE '$busqueda'
				)
				AND estado_manip = '$estado'");
			return $this->db->rowCount();

		}elseif ($busqueda != '' && !strpos($busqueda, ' ')) {

			$this->db->query(
				"SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab
				WHERE(
				id_manip LIKE '%$busqueda%' OR 
				LOWER(nombre_manip) LIKE '%$busqueda%' OR 
				LOWER(apellido_manip) LIKE '%$busqueda%' OR
				LOWER(nombre_estab) LIKE '%$busqueda%' OR
				LOWER(tipo_estab) LIKE '%$busqueda%' OR
				LOWER(dui_manip) LIKE '%$busqueda%'

				)
				AND estado_manip = '$estado'

				");
			return $this->db->rowCount();

		}else{

			$this->db->query("SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab WHERE estado_manip = '$estado'");
			return $this->db->rowCount();








		}

	}

	/*///////////////////////////////////////////////////////////////////////////*/
        //para la tabla inspecciones limite
	public function manipuladoresPorLimite($pos_pagina, $desde, $busqueda = null, $estado = 'Activo'){
		if ($busqueda != null && strpos($busqueda, ' ')) {

			$busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
			for($i = 0; $i < count($busquedaNombre); $i++){
				$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
			}
		        // convirtiendo el arreglo a str
			$busqueda = implode($busquedaNombre);

			$this->db->query(
				"SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab 
				WHERE( LOWER(CONCAT(nombre_manip,apellido_manip)) LIKE '$busqueda' OR
				LOWER(CONCAT(apellido_manip,' ',nombre_manip)) LIKE '$busqueda'
				)
				AND estado_manip = '$estado'
				LIMIT $desde, $pos_pagina
                    -- ORDER BY nombreusuario DESC
                    ");
			return $this->db->registers();

		}elseif ($busqueda != '' && !strpos($busqueda, ' ')) {

			$this->db->query(
				"SELECT SQL_CALC_FOUND_ROWS * FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab 
				WHERE(
				id_manip LIKE '%$busqueda%' OR 
				LOWER(nombre_manip) LIKE '%$busqueda%' OR 
				LOWER(apellido_manip) LIKE '%$busqueda%' OR
				LOWER(nombre_estab) LIKE '%$busqueda%' OR
				LOWER(tipo_estab) LIKE '%$busqueda%' OR
				LOWER(dui_manip) LIKE '%$busqueda%'
				)
				AND estado_manip = '$estado'
				LIMIT $desde, $pos_pagina
                -- ORDER BY nombreusuario DESC
                ");

			return $this->db->registers();
		}else{

			/*$this->db->query("SELECT * FROM tblmanipuladores WHERE estado_manip = '$estado' LIMIT $desde, $pos_pagina ");*/

			/*$this->db->query("SELECT nombre_manip, apellido_manip, dui_manip, puesto_manip, estado_manip, tblestablecimientos.nombre_estab FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab    WHERE estado_manip = '$estado' LIMIT $desde, $pos_pagina");*/


			$this->db->query("SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab    WHERE estado_manip = '$estado' LIMIT $desde, $pos_pagina");
			


			return $this->db->registers();

		}
	}

	/*///////////////////////////////////////////////////////////////////////////*/
	public function  manipuladoresPorLimiteBusqueda($pos_pagina, $desde, $busqueda){

		if (strpos($busqueda, ' ') == true) {

			$busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
			for($i = 0; $i < count($busquedaNombre); $i++){
				$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
			}
                // convirtiendo el arreglo a str
			$busqueda = implode($busquedaNombre);

			$this->db->query(
				"SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab 
				WHERE( LOWER(CONCAT(nombre_manip,apellido_manip)) LIKE '$busqueda' OR
				LOWER(CONCAT(apellido_manip,' ',nombre_manip)) LIKE '$busqueda'
				)
				AND estado_manip = 'Activo'
				LIMIT $desde, $pos_pagina
                    -- ORDER BY nombreusuario DESC
                    ");
			return $this->db->registers();

		}

		$this->db->query(
			"SELECT SQL_CALC_FOUND_ROWS * FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab 
			WHERE(
			id_manip LIKE '%$busqueda%' OR 
			LOWER(nombre_manip) LIKE '%$busqueda%' OR 
			LOWER(apellido_manip) LIKE '%$busqueda%' OR
			LOWER(nombre_estab) LIKE '%$busqueda%' OR
			LOWER(tipo_estab) LIKE '%$busqueda%' OR
			LOWER(dui_manip) LIKE '%$busqueda%'
			)
			AND estado_manip = 'Activo'
			LIMIT $desde, $pos_pagina
                -- ORDER BY nombreusuario DESC
                ");

		return $this->db->registers();
	}





	public function numeroRegistrosBusqueda($busqueda){

		if (strpos($busqueda, ' ') == true) {

			$busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
			for($i = 0; $i < count($busquedaNombre); $i++){
				$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
			}
                // convirtiendo el arreglo a str
			$busqueda = implode($busquedaNombre);

			$this->db->query(
				"SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab 
				WHERE( LOWER(CONCAT(nombre_manip,apellido_manip)) LIKE '$busqueda' OR
				LOWER(CONCAT(apellido_manip,' ',nombre_manip)) LIKE '$busqueda'
				)
				AND estado_manip = 'Activo'");
			return $this->db->rowCount();

		}

		$this->db->query(
			"SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab 
			WHERE(
			id_manip LIKE '%$busqueda%' OR 
			LOWER(nombre_manip) LIKE '%$busqueda%' OR 
			LOWER(apellido_manip) LIKE '%$busqueda%' OR
			LOWER(nombre_estab) LIKE '%$busqueda%' OR
			LOWER(tipo_estab) LIKE '%$busqueda%' OR
			LOWER(dui_manip) LIKE '%$busqueda%'
			)
			AND estado_manip = 'Activo'

			");
		return $this->db->rowCount();
	}


	public function TotalPaginacion(){

		/*$this->db->query("SELECT nombre_manip, apellido_manip, dui_manip, puesto_manip, estado_manip, tblestablecimientos.nombre_estab FROM tblmanipuladores INNER JOIN tblestablecimientos ON tblmanipuladores.id_estab = tblestablecimientos.id_estab    WHERE estado_manip = 'Activo'");*/
		$this->db->query("SELECT * FROM tblmanipuladores WHERE estado_manip = 'Activo'");
		return $this->db->rowCount();
	}
















           //agregar usuarios
	public function nuevoManipulador($manipulator, $usermod){

		$this->db->query(
			'INSERT INTO tblmanipuladores(
			dui_manip, nombre_manip, apellido_manip, genero_manip,
			fecha_nacim_manip, puesto_manip, estado_manip, id_estab, fecha_registro_manip, fecha_mod_manip, usermod, asistencia_check) 
			VALUES(:dui_manip, :nombre_manip, :apellido_manip, :genero_manip,
			:fechaNacimiento, :puesto_manip, "Activo", 
			:id_estab, now(), now(), :usermod, :asistencia_check)');

		$this->db->bind(':dui_manip', $manipulator['duimanip']['text']);
		$this->db->bind(':nombre_manip', $manipulator['nombremanip']['text']);
		$this->db->bind(':apellido_manip', $manipulator['apellidomanip']['text']);
		$this->db->bind(':genero_manip', $manipulator['generomanip']);
		$this->db->bind(':fechaNacimiento', $manipulator['fechaNacimiento']['text']);
		$this->db->bind(':puesto_manip', $manipulator['puestomanip']['text']);
		$this->db->bind(':usermod', $usermod);
		$this->db->bind(':asistencia_check', $manipulator['asistencia_check']);
		$this->db->bind(':id_estab', $manipulator['id_estab']);


		if ($this->db->execute()) {

			return TRUE;
		} else {
			return FALSE;
		}

	}



	public function actualizarManipulador($id, $manipulator, $usermod){


		$this->db->query(
			"UPDATE tblmanipuladores 
			SET  
			dui_manip = :dui_manip,
			nombre_manip = :nombre_manip,
			apellido_manip = :apellido_manip,
			genero_manip = :genero_manip,
			fecha_nacim_manip = now(),
			puesto_manip = :puesto_manip,
			estado_manip = 'Activo',
			id_estab = :id_estab,
			fecha_registro_manip = now(),
			fecha_mod_manip = now(),
			usermod = :usermod,
			asistencia_check = :asistencia_check


			WHERE id_manip = :id");
		$this->db->bind(':dui_manip', $manipulator['duimanip']['text']);
		$this->db->bind(':nombre_manip', $manipulator['nombremanip']['text']);
		$this->db->bind(':apellido_manip', $manipulator['apellidomanip']['text']);
		$this->db->bind(':genero_manip', $manipulator['generomanip']);
		/*$this->db->bind(':fecha_nacim_manip', $manipulator['fechaNacimiento']['text']);*/
		$this->db->bind(':puesto_manip', $manipulator['puestomanip']['text']);
		$this->db->bind(':usermod', $usermod);
		$this->db->bind(':asistencia_check', $manipulator['asistencia_check']);
		$this->db->bind(':id_estab', $manipulator['id_estab']);

		$this->db->bind(':id', $id);
		if ($this->db->execute()) {                
			return TRUE;
		} else {
			return FALSE;
		}

	}




	/*--------------------------------------------------------------------------------------------------------------------------------------*/
	public function desactivar($id){
		$this->db->query("UPDATE tblmanipuladores
			SET estado_manip  = 'Inactivo'
			WHERE id_manip = :id
			AND estado_manip = 'Activo'");
		$this->db->bind(':id', $id);
		if ($this->db->execute()) {

			return TRUE;
		} else {
			return FALSE;
		}
	}
	/*--------------------------------------------------------------------------------------------------------------------------------------*/
	/*--------------------------------------------------------------------------------------------------------------------------------------*/
	public function activar($id){
		$this->db->query("UPDATE tblmanipuladores
			SET estado_manip  = 'Activo'
			WHERE id_manip = :id
			AND estado_manip = 'Inactivo'");
		$this->db->bind(':id', $id);
		if ($this->db->execute()) {

			return TRUE;
		} else {
			return FALSE;
		}
	}








	
}

?>