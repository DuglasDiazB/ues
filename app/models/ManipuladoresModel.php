<?php

    class ManipuladoresModel{
        
        private $db;

        public function __construct(){

            $this->db = new Sql;
        }

        //obteniendo manipulador de acuerdo al numero de DUI
        public function getManipulador($dui){
            
            $this->db->query(
                "SELECT tblmanipuladores.id_manip, dui_manip, nombre_manip, apellido_manip, genero_manip, fecha_nacim_manip,
                         puesto_manip, token, estado_manip, tblestablecimientos.id_estab,
                         nombre_estab,
                         estado_exam, fecha_exped_exam, 
                         DATE_FORMAT(fechamodexamen, '%Y-%m-%d') as fechamodexamen
                FROM tblmanipuladores
                INNER JOIN tblestablecimientos ON  tblmanipuladores.id_estab = tblestablecimientos.id_estab
                INNER JOIN tblexamenes ON tblmanipuladores.id_manip = tblexamenes.id_manip
                INNER JOIN tblasistencias ON tblasistencias.id_exam = tblexamenes.id_exam
                WHERE dui_manip   = '$dui' AND estado_manip = 'Activo'");
            return $this->db->register();

        }

        //obteniendo todos los manipuladores de alimentos
        public function getAllManipuladores(){

            $this->db->query(
                "SELECT tblmanipuladores.id_manip, dui_manip, nombre_manip, apellido_manip, genero_manip, fecha_nacim_manip,
                         puesto_manip, token, estado_manip, tblestablecimientos.id_estab,
                         nombre_estab,
                         estado_exam, fecha_exped_exam, 
                         DATE_FORMAT(fechamodexamen, '%Y-%m-%d') as fechamodexamen
                FROM tblmanipuladores
                INNER JOIN tblestablecimientos ON  tblmanipuladores.id_estab = tblestablecimientos.id_estab
                INNER JOIN tblexamenes ON tblmanipuladores.id_manip = tblexamenes.id_manip
                INNER JOIN tblasistencias ON tblasistencias.id_exam = tblexamenes.id_exam
                WHERE estado_manip = 'Activo'
                AND token IS NOT NULL
                ");
            return $this->db->registers();

        }

        public function actualizarAsistencia($idExam, $idAsistencia){

            $this->db->query(
                "UPDATE tblasistencias 
                 SET id_exam = :id_exam,
                    asistencia = 'No',
                    fecha_asist_capacit  = null,
                    usermod = null,
                    fechamodasistencia = null            
                WHERE id_asistencia = :id_asistencia
            ");
            $this->db->bind(':id_exam', $idExam);
            $this->db->bind(':id_asistencia', $idAsistencia);
           
            if ($this->db->execute()) {
                return TRUE;
            } else {
                return FALSE;
            }

        }

        
        public function getFechaCapacitaciones(){

            $this->db->query(
                
                "SELECT  IFNULL(DATE_FORMAT(fecha_inicio_capacit, '%d de %M del %Y'), 'No establecida') as fecha_inicio_capacit, 
                         IFNULL(DATE_FORMAT(fecha_fin_capacit, '%d de %M del %Y'), 'No establecida') as fecha_fin_capacit              
                FROM tblfechacapacitaciones                
                WHERE  id_fechacapacit   = 1");
            return $this->db->register();

        }

        public function getFechaCapacSinFormato(){

            $this->db->query(
                
                "SELECT  *             
                FROM tblfechacapacitaciones                
                WHERE  id_fechacapacit   = 1");
            return $this->db->register();

        }
        //obteniendo informacion sobre la credencial con el id del manipulador correspondiente
        public function getCredencial($idManipulador){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();
            $this->db->query(
                "SELECT
                id_creden,
                id_manip,          
                estado_creden,        
                IFNULL(DATE_FORMAT(fecha_emis_creden, '%W %d de %M del %Y'), 'Sin fecha') as fecha_emis,  
                IFNULL(DATE_FORMAT(fecha_exped_creden, '%W %d de %M del %Y'), 'Sin fecha') as fecha_exped
                FROM tblcredenciales
                WHERE id_manip = '$idManipulador'");
            return $this->db->register();

        }

        public function obtenerAsistencia1($id){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();

            $this->db->query("SELECT id_asistencia, tblexamenes.id_exam, asistencia, 
             IFNULL( DATE_FORMAT(fechamodasistencia, '%W %d de %M del %Y'),'sin fecha' )as fechamodasistencia,
             IFNULL( tblasistencias.usermod, 'sin usuario') as usermod,  
                fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab
                FROM tblasistencias  
                INNER JOIN tblexamenes
                ON tblasistencias.id_exam = tblexamenes.id_exam
                INNER JOIN tblmanipuladores
                ON tblmanipuladores.id_manip = tblexamenes.id_manip
                INNER JOIN tblestablecimientos
                ON tblestablecimientos.id_estab = tblmanipuladores.id_estab
                WHERE id_asistencia = :id
                
            ");
            $this->db->bind(':id', $id);

            return $this->db->register();
        }
        

        //actualizando el estado de la credencial cuando se ha llegado a la fecha limite
        public function desactivarCredencial($credencial){
              
            $this->db->query(
                "UPDATE tblcredenciales 
                 SET id_manip = :id_manip,
                     estado_creden = 'Inactivo',
                     fecha_emis_creden  = null,
                     fecha_exped_creden = null            
                WHERE id_creden = :id_creden
            ");
            $this->db->bind(':id_manip', $credencial->id_manip);
            $this->db->bind(':id_creden', $credencial->id_creden);
           
            if ($this->db->execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        //Guardando token de manipulador
        public function saveTokenManipulador($manipulador, $token){

            $this->db->query(
                "UPDATE tblmanipuladores 
                SET dui_manip = :dui_manip,
                    nombre_manip = :nombre_manip,
                    apellido_manip = :apellido_manip,
                    genero_manip = :genero_manip,
                    fecha_nacim_manip = :fecha_nacim_manip,
                    puesto_manip = :puesto_manip,
                    token = :token,
                    estado_manip = :estado_manip,
                    id_estab = :id_estab                    
                WHERE id_manip = :id_manip"
            );

            $this->db->bind(':dui_manip', $manipulador->dui_manip);
            $this->db->bind(':nombre_manip', $manipulador->nombre_manip);
            $this->db->bind(':apellido_manip', $manipulador->apellido_manip);
            $this->db->bind(':genero_manip', $manipulador->genero_manip);
            $this->db->bind(':fecha_nacim_manip', $manipulador->fecha_nacim_manip);
            $this->db->bind(':puesto_manip', $manipulador->puesto_manip);
            $this->db->bind(':token', $token);
            $this->db->bind(':estado_manip', $manipulador->estado_manip);
            $this->db->bind(':id_estab', $manipulador->id_estab);
            $this->db->bind(':id_manip', $manipulador->id_manip);
            
            if ($this->db->execute()) {
                return TRUE;
            } else {
                return FALSE;
            }

        }

        // /preparando las notificaciones 

        //obtenemos todas las credenciales que tengan fecha de expedicion
        public function getAllCredenciales(){
            $this->db->query(

                "SELECT * 
                FROM tblcredenciales c
                INNER JOIN tblmanipuladores m
                ON c.id_manip = m.id_manip
                WHERE estado_creden = 'Activo'"
            );
            return $this->db->registers();
        }

        //restando fecha a 7 dias
        public function restandoFecha($fecha, $dias){
            $this->db->query(

                "SELECT SUBDATE('$fecha', INTERVAL '$dias' DAY) as fecha_rest"
            );
            return $this->db->register();

        }

        //desactivar examen de manipulador

        public function desactivarExamen($idExam, $idManip){

            $this->db->query(
                "UPDATE tblexamenes 
                 SET id_manip = :id_manip,
                     fecha_entrega_so = null,
                     exam_s = 'No entregado',
                     exam_o = 'No entregado',
                     fecha_entrega_so2 = null,
                     exam_s2 = 'No entregado',
                     exam_o2 = 'No entregado',
                     estado_exam = 'No acto',
                     fecha_exped_exam = null,
                     fechamodexamen = null,
                     usermod = null                             
                WHERE id_exam = :id_exam
            ");

            $this->db->bind(':id_manip', $idManip);
            $this->db->bind(':id_exam', $idExam);
           
            if ($this->db->execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        //fecha actual donde le damos un formato anio mes dia
        public function ahora(){
            $this->db->query(
                
                "SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') as hoy"
            );
            return $this->db->register();
            
        }
        
        //fecha actual con formato
        public function ahoraConformato(){
            $this->db->query(
                
                "SELECT DATE_FORMAT(NOW(), '%W %d de %M del %Y a las %H:%i') as hoy_con_formato"
            );
            return $this->db->register();

        }

        //fecha actual donde le damos un formato anio mes dia
        public function fechaExpedicion($idManipulador){
            $this->db->query(
                
                "SELECT fecha_exped_creden 
                FROM tblcredenciales
                WHERE id_manip = $idManipulador"
            );
            return $this->db->register();

        }

        //obteniendo examen de manipulador
        public function examenManipulador($idManipulador){
            $this->db->query(
                
                "SELECT * 
                FROM tblexamenes
                WHERE id_manip = $idManipulador"
            );
            return $this->db->register();

        }
        

        //fomatear fecha
        public function fechaConformato($fecha){
      
            $this->db->query(
                
                "SELECT DATE_FORMAT('$fecha', '%d-%m-%Y') as fecha_con_formato"
            );
            return $this->db->register();

        }


    }
?>