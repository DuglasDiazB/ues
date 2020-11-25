<?php 
class ModeloReportes{
	private $db;




public function __construct(){
	$this->db = new Sql();
}


public function obtenerManipuladores(){
	$this->db->query("SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab");
	return $this->db->registers();
}

public function comprobarUser($user, $pass){
        
	$this->db->query('SELECT * FROM usuarios WHERE username= :user and password = :pass and estadousuario = 1');
	$this->db->bind(':user', $user);
	$this->db->bind(':pass', $pass);
	
	return $this->db->register();
}


public function reporteManipuladoresActivos(){
	$this->db->query("SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab WHERE estado_manip = 'Activo'");
	return $this->db->registers();
}


public function reporteManipuladoresInactivos(){
	$this->db->query("SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab WHERE estado_manip = 'Inactivo'");
	return $this->db->registers();
}


public function reporteManipuladoresFormales(){
	$this->db->query("SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab WHERE tblestablecimientos.tipo_estab = 'Formal' AND tblmanipuladores.estado_manip = 'Activo'");
	return $this->db->registers();
}


public function reporteManipuladoresInformales(){
	$this->db->query("SELECT * FROM tblmanipuladores INNER JOIN tblestablecimientos on tblmanipuladores.id_estab = tblestablecimientos.id_estab WHERE tblestablecimientos.tipo_estab = 'Informal' AND tblmanipuladores.estado_manip = 'Activo'");
	return $this->db->registers();
}

}

 ?>