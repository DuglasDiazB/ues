<?php 
class ModeloReportes{
	private $db;




public function __construct(){
	$this->db = new Sql();
}




        //************************************************************************************************************************************ */        
        //2-para las opciones de la tabla ver asistencia
        public function generarCredencial($id, $estadoCreden = 'Activo'){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();

            $this->db->query("SELECT tblcredenciales.id_creden, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                                    tblcredenciales.estado_creden,
                                    tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                                    tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                                    tblexamenes.estado_exam, tipo_estab, nombre_estab,
                                    tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                            FROM tblcredenciales
                            INNER JOIN tblmanipuladores
                            ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                            INNER JOIN tblexamenes
                            ON tblexamenes.id_manip = tblmanipuladores.id_manip
                            INNER JOIN tblasistencias 
                            ON tblasistencias.id_exam = tblexamenes.id_exam 
                            INNER JOIN tblestablecimientos
                                    ON tblmanipuladores.id_estab = tblestablecimientos.id_estab 
                            WHERE id_creden = :id
                            AND estado_creden = '$estadoCreden' 
                ");
            $this->db->bind(':id', $id);

            return $this->db->register();
        } 




/*#################  REPORTES DEL MODULO USUARIOS #########################*/

public function obtenerUsuarios(){
	$this->db->query("SELECT * FROM usuarios INNER JOIN tipousuarios on usuarios.idtipousuario = tipousuarios.idtipousuario");
	return $this->db->registers();
}


public function obtenerUsuariosActivos(){
	$this->db->query("SELECT * FROM usuarios INNER JOIN tipousuarios on usuarios.idtipousuario = tipousuarios.idtipousuario WHERE estadousuario = 1" );
	return $this->db->registers();
}


public function obtenerUsuariosInactivos(){
	$this->db->query("SELECT * FROM usuarios INNER JOIN tipousuarios on usuarios.idtipousuario = tipousuarios.idtipousuario WHERE estadousuario = 2" );
	return $this->db->registers();
}




/*#################  REPORTES DEL MODULO MANIPULADORES #########################*/
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



/*#################  REPORTES DEL MODULO ESTABLECIMIENTOS #########################*/

public function obtenerEstablecimientos(){
	$this->db->query("SELECT * FROM tblestablecimientos");
	return $this->db->registers();
}



public function obtenerEstablecimientosActivos(){
	$this->db->query("SELECT * FROM tblestablecimientos WHERE estado_estab = 'Activo'");
	return $this->db->registers();
}

public function obtenerEstablecimientosInactivos(){
	$this->db->query("SELECT * FROM tblestablecimientos WHERE estado_estab = 'Inactivo'");
	return $this->db->registers();
}


public function obtenerEstablecimientosA(){
	$this->db->query("SELECT * FROM tblestablecimientos WHERE apartado_especifico = 'A'");
	return $this->db->registers();
}


public function obtenerEstablecimientosB(){
	$this->db->query("SELECT * FROM tblestablecimientos WHERE apartado_especifico = 'B'");
	return $this->db->registers();
}


public function obtenerEstablecimientosC(){
	$this->db->query("SELECT * FROM tblestablecimientos WHERE apartado_especifico = 'C'");
	return $this->db->registers();
}

public function obtenerEstablecimientosD(){
	$this->db->query("SELECT * FROM tblestablecimientos WHERE apartado_especifico = 'D'");
	return $this->db->registers();
}



/*#################  REPORTES DEL MODULO INSPECCIONES #########################*/

public function obtenerInspeciones(){
	$this->db->query("SELECT * FROM tblinspecciones INNER JOIN tblestablecimientos on tblinspecciones.id_estab = tblestablecimientos.id_estab");
	return $this->db->registers();
}
















}

 ?>