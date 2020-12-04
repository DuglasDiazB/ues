<?php 
class ModeloEstablecimientos{

	private $db;
	public $id_estab;
	public $nombre_estab;
	public $dui_prop;
	public $nombre_prop;
	public $apellido_prop;
	public $direccion_estab;
	public $cat_estab;
	public $tipo_estab;
	public $apartado_especifico;
	public $telefono_estab;
	public $municipio_estab;
	public $departamento_estab;
	public $estado_estab;
	public $fecha_reg_estab;
	public $fecha_mod_estab;
	public $usermod;


	public function __construct(){
		$this->db = new Sql;
	}


        //Asignado valores del formulario a cada propiedad si esta existe
	public function set_datos($datos){

		foreach ($datos as $nombre_campo => $valor_campo) {

			if (property_exists('ModeloEstablecimientos', $nombre_campo)) {

				$this->$nombre_campo = $valor_campo;
			}
		}
		return $this;
	}


         //DONDE SE CREARAN LAS CONSULTAS

        //****************************************************************************************************************************** */
        //1-creando archivo index donde llevara la vista mostrando la tabla de inspecciones
	public function obtenerEstablecimientos(){

		$this->db->query("SELECT * FROM tblestablecimientos");

		return $this->db->registers();
	}
	/*///////////////////////////////////////////////////////////////////////////*/


	public function obtenerEstablecimiento($id, $estado = 'Inactivo'){
		$this->db->query("SET lc_time_names = 'es_ES'");
		$this->db->execute();
		$this->db->query(
			"SELECT id_estab,
			nombre_estab,
			dui_prop,
			nombre_prop,
			apellido_prop,
			direccion_estab,
			cat_estab,
			tipo_estab,
			apartado_especifico,
			telefono_estab,
			municipio_estab,
			departamento_estab,
			estado_estab,
			usermod,

			DATE_FORMAT(fecha_mod_estab, 'ultima modificación %W %d de %M del %Y a las %H:%i') as fecha_mod_estab,
			fecha_reg_estab
			FROM tblestablecimientos 
			WHERE id_estab = :id and estado_estab = '$estado'");
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
				"SELECT * FROM tblestablecimientos
				WHERE( LOWER(CONCAT(nombre_prop,apellido_prop)) LIKE '$busqueda' OR
				LOWER(CONCAT(apellido_prop,' ',nombre_prop)) LIKE '$busqueda' OR
				LOWER(nombre_estab) LIKE '%$busqueda%'
				)
				AND estado_estab = '$estado'");
			return $this->db->rowCount();

		}elseif ($busqueda != '' && !strpos($busqueda, ' ')) {

			$this->db->query(
				"SELECT * FROM tblestablecimientos
				WHERE(
				id_estab LIKE '%$busqueda%' OR 
				LOWER(nombre_prop) LIKE '%$busqueda%' OR 
				LOWER(apellido_prop) LIKE '%$busqueda%' OR
				LOWER(nombre_estab) LIKE '%$busqueda%' OR
				LOWER(tipo_estab) LIKE '$busqueda'

				)
				AND estado_estab = '$estado'

				");
			return $this->db->rowCount();

		}else{

			$this->db->query("SELECT * FROM tblestablecimientos WHERE estado_estab = '$estado'");
			return $this->db->rowCount();

		}

	}

	/*///////////////////////////////////////////////////////////////////////////*/
        //para la tabla inspecciones limite
	public function establecimientosPorLimite($pos_pagina, $desde, $busqueda = null, $estado = 'Activo'){
		if ($busqueda != null && strpos($busqueda, ' ')) {

			$busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
			for($i = 0; $i < count($busquedaNombre); $i++){
				$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
			}
		        // convirtiendo el arreglo a str
			$busqueda = implode($busquedaNombre);

			$this->db->query(
				"SELECT * FROM tblestablecimientos
				WHERE( LOWER(CONCAT(nombre_prop, apellido_prop)) LIKE '$busqueda' OR
				LOWER(CONCAT(apellido_prop,' ',nombre_prop)) LIKE '$busqueda' OR
				LOWER(nombre_estab) LIKE '%$busqueda%'
				)
				AND estado_estab = '$estado'
				LIMIT $desde, $pos_pagina
                    -- ORDER BY nombreusuario DESC
                    ");
			return $this->db->registers();

		}elseif ($busqueda != '' && !strpos($busqueda, ' ')) {

			$this->db->query(
				"SELECT SQL_CALC_FOUND_ROWS * FROM tblestablecimientos
				WHERE(
				id_estab LIKE '%$busqueda%' OR 
				LOWER(nombre_prop) LIKE '%$busqueda%' OR 
				LOWER(apellido_prop) LIKE '%$busqueda%' OR
				LOWER(nombre_estab) LIKE '%$busqueda%' OR
				LOWER(tipo_estab) LIKE '$busqueda'
				)
				AND estado_estab = '$estado'
				LIMIT $desde, $pos_pagina
                -- ORDER BY nombreusuario DESC
                ");

			return $this->db->registers();
		}else{

			$this->db->query("SELECT * FROM tblestablecimientos WHERE estado_estab = '$estado' LIMIT $desde, $pos_pagina ");

			return $this->db->registers();

		}
	}

	/*///////////////////////////////////////////////////////////////////////////*/
	public function  establecimientosPorLimiteBusqueda($pos_pagina, $desde, $busqueda){

		if (strpos($busqueda, ' ') == true) {

			$busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
			for($i = 0; $i < count($busquedaNombre); $i++){
				$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
			}
                // convirtiendo el arreglo a str
			$busqueda = implode($busquedaNombre);

			$this->db->query(
				"SELECT * FROM tblestablecimientos
				WHERE( LOWER(CONCAT(nombre_prop,apellido_prop)) LIKE '$busqueda' OR
				LOWER(CONCAT(apellido_prop,' ',nombre_prop)) LIKE '$busqueda' OR
				LOWER(nombre_estab) LIKE '%$busqueda%'
				)
				AND estado_estab = 'Activo'
				LIMIT $desde, $pos_pagina
                    -- ORDER BY nombreusuario DESC
                    ");
			return $this->db->registers();

		}

		$this->db->query(
			"SELECT SQL_CALC_FOUND_ROWS * FROM tblestablecimientos
			WHERE(
			id_estab LIKE '%$busqueda%' OR 
			LOWER(nombre_prop) LIKE '%$busqueda%' OR 
			LOWER(apellido_prop) LIKE '%$busqueda%' OR
			LOWER(nombre_estab) LIKE '%$busqueda%' OR
			LOWER(tipo_estab) LIKE '$busqueda'
			)
			AND estado_estab = 'Activo'
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
				"SELECT * FROM tblestablecimientos
				WHERE( LOWER(CONCAT(nombre_prop,apellido_prop)) LIKE '$busqueda' OR
				LOWER(CONCAT(apellido_prop,' ',nombre_prop)) LIKE '$busqueda' OR
				LOWER(nombre_estab) LIKE '%$busqueda%'
				)
				AND estado_estab = 'Activo'");
			return $this->db->rowCount();

		}

		$this->db->query(
			"SELECT * FROM tblestablecimientos
			WHERE(
			id_estab LIKE '%$busqueda%' OR 
			LOWER(nombre_prop) LIKE '%$busqueda%' OR 
			LOWER(apellido_prop) LIKE '%$busqueda%' OR
			LOWER(nombre_estab) LIKE '%$busqueda%' OR
			LOWER(tipo_estab) LIKE '$busqueda'
			)
			AND estado_estab = 'Activo'

			");
		return $this->db->rowCount();
	}


	public function TotalPaginacion(){
		$this->db->query("SELECT * FROM tblestablecimientos WHERE estado_estab = 'Activo'");
		return $this->db->rowCount();
	}
















           //agregar usuarios
	public function nuevoEstablecimiento($establishment, $usermod){



		$this->db->query(
			'INSERT INTO tblestablecimientos(
			nombre_estab, dui_prop, nombre_prop, apellido_prop, direccion_estab, cat_estab, tipo_estab, apartado_especifico, telefono_estab, municipio_estab, departamento_estab, estado_estab, fecha_reg_estab, fecha_mod_estab, usermod) 
			VALUES(:nombre_estab, :dui_prop, :nombre_prop, :apellido_prop, :direccion_estab, :cat_estab, :tipo_estab, :apartado_especifico, :telefono_estab, :municipio_estab, :departamento_estab, "Activo",  now(), now(), :usermod)');

		$this->db->bind(':nombre_estab', $establishment['nombre_estab']['text']);
		$this->db->bind(':dui_prop', $establishment['dui_prop']['text']);
		$this->db->bind(':nombre_prop', $establishment['nombre_prop']['text']);
		$this->db->bind(':apellido_prop', $establishment['apellido_prop']['text']);
		$this->db->bind(':direccion_estab', $establishment['direccion_estab']['text']);
		$this->db->bind(':cat_estab', $establishment['cat_estab']['text']);
		$this->db->bind(':tipo_estab', $establishment['tipo_estab']);
		$this->db->bind(':apartado_especifico', $establishment['apartado_especifico']);
		$this->db->bind(':telefono_estab', $establishment['telefono_estab']['text']);
		$this->db->bind(':municipio_estab', $establishment['municipio_estab']['text']);
		$this->db->bind(':departamento_estab', $establishment['departamento_estab']['text']);
		$this->db->bind(':usermod', $usermod);








		if ($this->db->execute()) {

			return TRUE;
		} else {
			return FALSE;
		}

	}





	public function actualizarEstablecimiento($id, $establishment, $usermod){


		$this->db->query(
			"UPDATE tblestablecimientos 
			SET nombre_estab = :nombre_estab,
			dui_prop = :dui_prop,
			nombre_prop = :nombre_prop,
			apellido_prop = :apellido_prop,
			direccion_estab = :direccion_estab,
			cat_estab = :cat_estab,
			tipo_estab = :tipo_estab,
			apartado_especifico = :apartado_especifico,
			telefono_estab = :telefono_estab,
			municipio_estab = :municipio_estab,
			departamento_estab = :departamento_estab,
			estado_estab = 'Activo',
			fecha_reg_estab = now(),
			fecha_mod_estab = now(),
			usermod = :usermod


			WHERE id_estab = :id");
		$this->db->bind(':nombre_estab', $establishment['nombre_estab']['text']);
		$this->db->bind(':dui_prop', $establishment['dui_prop']['text']);
		$this->db->bind(':nombre_prop', $establishment['nombre_prop']['text']);
		$this->db->bind(':apellido_prop', $establishment['apellido_prop']['text']);
		$this->db->bind(':direccion_estab', $establishment['direccion_estab']['text']);
		$this->db->bind(':cat_estab', $establishment['cat_estab']['text']);
		$this->db->bind(':tipo_estab', $establishment['tipo_estab']);
		$this->db->bind(':apartado_especifico', $establishment['apartado_especifico']);
		$this->db->bind(':telefono_estab', $establishment['telefono_estab']['text']);
		$this->db->bind(':municipio_estab', $establishment['municipio_estab']['text']);
		$this->db->bind(':departamento_estab', $establishment['departamento_estab']['text']);
		$this->db->bind(':usermod', $usermod);

		$this->db->bind(':id', $id);
		if ($this->db->execute()) {                
			return TRUE;
		} else {
			return FALSE;
		}

	}



	/*--------------------------------------------------------------------------------------------------------------------------------------*/
	public function desactivar($id){
		$this->db->query("UPDATE tblestablecimientos
			SET estado_estab  = 'Inactivo'
			WHERE id_estab = :id
			AND estado_estab = 'Activo'");
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
		$this->db->query("UPDATE tblestablecimientos
			SET estado_estab  = 'Activo'
			WHERE id_estab = :id
			AND estado_estab = 'Inactivo'");
		$this->db->bind(':id', $id);
		if ($this->db->execute()) {

			return TRUE;
		} else {
			return FALSE;
		}
	}

	//obteniendo total asistencias formales e informales
	public function establecimientosForInf($tipoEstab, $estado_estab){

		$this->db->query(
			"SELECT *
			FROM tblestablecimientos
				
			WHERE tipo_estab = '$tipoEstab'
			AND estado_estab = '$estado_estab'
			
		");
		return $this->db->rowCount();

	}

	
}

?>